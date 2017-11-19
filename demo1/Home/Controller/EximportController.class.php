<?php
/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/7
 * Time: 上午10:14
 */
namespace Home\Controller;
use Think\Controller;
class EximportController extends Controller
{

    public function eximport()
    {
        $this->display();
    }
    public function exportpdf(){

        $list = M('info')->select();
        $row = array();
        $title = array('number', 'username', 'password', 'student_id');
        $i = 0;
        foreach ($list as $v) {
            $row[$i]['id'] = $i;
            $row[$i]['username'] = $v['username'];
            $row[$i]['password'] = $v['password'];
            $row[$i]['student_id'] = $v['student_id'];
            $i++;
        }

        $this->export_pdf($title,$row);
    }

    //导入
    public function import()
    {
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts = array('xls', 'csv', 'xlsx');
        $upload->rootPath = './Uploads';
        $upload->savePath = '/excel/';
        $info = $upload->upload();

        if (!$info) {
            $this->error($upload->getError());
        } else {

           // print_r($info);
           $filename = './Uploads/' . $info['excel']['savepath'] . $info['excel']['savename'];
            import("Org.Yufan.ExcelReader");
            $ExcelReader = new \ExcelReader();
            $arr = $ExcelReader->reader_excel($filename);

            //print_r("$arr");
            foreach ($arr as $key => $value) {
              //  $data['id'] = $arr[$key]['0'];
                $data['username'] = $arr[$key]['1'];
                $data['password'] = $arr[$key]['2'];
                $data['student_id'] = $arr[$key]['3'];
                if($arr[$key]['0']>10000){
                    $this->error("最多一次导入一万条数据",'eximport');
                }
                M('info')->add($data);
            }
            $this->success('导入成功');
        }
    }

    //导出为excel
    public function export()
    {
        import("ORG.Yufan.Excel");
        $list = M('info')->select();
        //print_r($list);
        $row = array();
        $row[0] = array('序号', '用户名', '密码', '学生账号');
        $i = 1;
        foreach ($list as $v) {
            $row[$i]['id'] = $i;
            $row[$i]['username'] = $v['username'];
            $row[$i]['password'] = $v['password'];
            $row[$i]['student_id'] = $v['student_id'];
            $i++;
        }

        $xls = new \Excel_XML('UTF-8', false, 'datalist');
        $xls->addArray($row);
        $xls->generateXML("shzu");
    }


     //导出为PDF
    public function export_pdf($header=array(),$data=array(),$fileName='Newfile'){
        set_time_limit(120);
        if(empty($header) || empty($data)) $this->error("导出的数据为空！");
        vendor("tcpdf.tcpdf");
        require_cache(VENDOR_PATH . 'tcpdf/examples/lang/eng.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);//新建pdf文件
        //设置文件信息
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Author");
        $pdf->SetTitle("pdf test");
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //设置页眉页脚
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'www.thinkphp.com','Copyright © 2017-2020 by wenlei, Ltd. All Rights reserved',array(66,66,66), array(0,0,0));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);//设置默认等宽字体
        $pdf->SetMargins(PDF_MARGIN_LEFT, 24, PDF_MARGIN_RIGHT);//设置页面边幅
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);//设置自动分页符
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setLanguageArray($l);
        $pdf->SetFont('droidsansfallback', '');
        $pdf->AddPage();

        $pdf->SetFillColor(245, 245, 245);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(66, 66, 66);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('droidsansfallback', '',9);
        // Header
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $pdf->Cell(180/$num_headers, 8, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();

        // 填充数据
        $fill = 0;
        foreach($data as $list) {
            //每頁重复表格标题行
            if(($pdf->getPageHeight()-$pdf->getY())<($pdf->getBreakMargin()+2)){
                $pdf->SetFillColor(245, 245, 245);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(66, 66, 66);
                $pdf->SetLineWidth(0.3);
                $pdf->SetFont('droidsansfallback', '',9);
                // Header
                for($i = 0; $i < $num_headers; ++$i) {
                    $pdf->Cell(180/$num_headers, 8, $header[$i], 1, 0, 'C', 1);
                }
                $pdf->Ln();
            }
            // Color and font restoration
            $pdf->SetFillColor(245, 245, 245);
            $pdf->SetTextColor(40);
            $pdf->SetLineWidth(0.1);
            $pdf->SetFont('droidsansfallback', '');
            foreach($list as $key=>$row){
                //$pdf->Cell($width, 6, $row, 'LR', 0, 'C', $fill);
                $pdf->MultiCell(180/$num_headers, 6, $row, $border=1, $align='C',$fill, $ln=0, $x='', $y='',  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='C', $fitcell=true);
            }
            $pdf->Ln();
            $fill=!$fill;
        }
        $showType= 'D';//PDF输出的方式。I，在浏览器中打开；D，以文件形式下载；F，保存到服务器中；S，以字符串形式输出；E：以邮件的附件输出。
        $pdf->Output("{$fileName}.pdf", $showType);
        exit;
    }


}