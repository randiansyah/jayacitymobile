<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

class PDF 
{

    public function generate(
        $html, 
        $filename="", 
        $stream=TRUE, 
        $paper = 'A4', 
        $orientation = "portrait")
    {
        define('DOMPDF_ENABLE_AUTOLOAD', false);
        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        
        if ($stream) { 
            $dompdf->stream($filename, array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }

    public function save($html, $filename="", $paper = 'A4', $orientation = "portrait")
    {
        define('DOMPDF_ENABLE_AUTOLOAD', false);
        define("DOMPDF_ENABLE_REMOTE", false);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $output = $dompdf->output();

        $dir = FCPATH.'assets/upload/file/surat/';

        if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
		}

        file_put_contents($dir.$filename, $output);
    }

    public function preview($html, $filename="", $paper = 'A4', $orientation = "portrait")
    {
        define('DOMPDF_ENABLE_AUTOLOAD', false);
        define("DOMPDF_ENABLE_REMOTE", false);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $output = $dompdf->output();

        $dir = FCPATH.'assets/upload/file/surat/preview/';

        if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
		}

        file_put_contents($dir.$filename, $output);
    }

    public function update($html, $filename="", $paper = 'A4', $orientation = "portrait")
    {
        define('DOMPDF_ENABLE_AUTOLOAD', false);
        define("DOMPDF_ENABLE_REMOTE", false);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $output = $dompdf->output();

        $dir = FCPATH.'assets/upload/file/surat/ttd/';

        if (!is_dir($dir)) {
			mkdir($dir, 0777, true);
		}

        file_put_contents($dir.$filename, $output);
    }
}
