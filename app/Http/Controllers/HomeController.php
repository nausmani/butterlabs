<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use function Sodium\randombytes_uniform;
use Spatie\PdfToText\Pdf;
use thiagoalessio\TesseractOCR\TesseractOCR;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $parser = new Parser();
        $pdf = $parser->parseFile('http://butterlabs.local/uploads/1616322422.pdf');
        $text = $pdf->getText();
//        $pages  = $pdf->getDetails();
        echo "<pre>";
        print_r($text);
        echo "</pre>";

echo "*****************************************************";

//        echo "<img src='http://butterlabs.local/uploads/4089.png'>";
//        echo (new TesseractOCR('http://butterlabs.local/uploads/4089.png'))->run();
//        echo "<pre>";
//        print_r($pages);
//        echo "</pre>";
echo "*****************************************************";
//        $details  = $pdf->getDetails();
//        echo "<pre>";
//        print_r($details);
//        echo "</pre>";

        exit;

        return view('home');
    }
}
