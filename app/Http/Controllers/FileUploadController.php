<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;



class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('fileUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);

    }


    public function frontier(Request $req)
    {
        $data = [
            'formHeading' => 'Frontier Communications Invoice Upload',
            'formAction' => '/pdf-upload/frontier',
        ];
        return view('fileUpload', $data);
    }

    public function comcast(Request $req)
    {
        $data = [
            'formHeading' => 'Comcast Business Invoice Upload',
            'formAction' => '/pdf-upload/comcast',
        ];
        return view('fileUpload', $data);
    }

    public function redNight(Request $req)
    {
        $data = [
            'formHeading' => 'Red Night Consulting Inc. Invoice Upload',
            'formAction' => '/pdf-upload/rednight',
        ];
        return view('fileUpload', $data);
    }


    private function contains($line, $word)
    {
        $line = str_replace(' ', '', $line);
        return stripos($line, $word);
    }


    public function frontierHandle(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:pdf|max:512',
        ]);

        $fileName = 'frontier_' . time() . '.' . $req->file->extension();
        $req->file->move(public_path('uploads'), $fileName);

        $parser = new Parser();
        $pdf = $parser->parseFile(public_path('uploads/') . $fileName);
        $text = explode("\n", $pdf->getText());

        $data = [];

        foreach ($text as $key => $line) {

            $line = str_replace("\t", '', $line);

            echo "**************";
            echo "<pre>";
            print_r(strtolower(str_replace(' ', '', $line)));
            echo "</pre>";
            echo "**************";

            if ($line == "Account number") {
            
                $data['account_number'] = str_replace("\t", '', $text[$key+1]);
            
            } else if (substr($line, 0, 9) == 'Blll date') {

                $data['bill_date'] = substr($line, 10, 12);
            
            } else if (substr($line, 0, 11) == 'Payment due') {

                $data['payment_due'] = str_replace('.', ', ', substr($line, 11));
            }

        }

        dd($data);
    }

    public function comcastHandle(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:pdf|max:512',
        ]);

        $fileName = 'comcast_' . time() . '.' . $req->file->extension();
        $req->file->move(public_path('uploads'), $fileName);

        $parser = new Parser();
        $pdf = $parser->parseFile(public_path('uploads/') . $fileName);
        $text = explode("\n", $pdf->getText());

        $data = [];

        foreach ($text as $key => $line) {

            $line = str_replace("\t", '', $line);

            if ($line == "Account number") {

                $data['account_number'] = str_replace("\t", '', $text[$key+1]);

            } else if (substr($line, 0, 9) == 'Blll date') {

                $data['bill_date'] = substr($line, 10, 12);

            } else if (substr($line, 0, 11) == 'Payment due') {

                $data['payment_due'] = str_replace('.', ', ', substr($line, 11));
            }

        }

        dd($data);
    }

    public function redNightHandle(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:pdf|max:512',
        ]);

        $fileName = 'rednight_' . time() . '.' . $req->file->extension();
        $req->file->move(public_path('uploads'), $fileName);

        $parser = new Parser();
        $pdf = $parser->parseFile(public_path('uploads/') . $fileName);

        $text = explode("\n", $pdf->getText());

        $data = [];

        foreach ($text as $key => $line) {

            $line = str_replace("\t", '', $line);

            if (strtolower(str_replace(' ', '', $line)) == "account") {

                $data['account_name'] = str_replace("\t", '', $text[$key+1]);

            } else if (strtolower(str_replace(' ', '', $line)) == "billto:") {

                $data['bill_to'] = str_replace("\t", '', $text[$key+1]);

            } else if (strtolower(str_replace(' ', '', $line)) == "shipto") {

                $data['ship_to'] = str_replace("\t", '', $text[$key+1]);

            } else if (strtolower(str_replace(' ', '', $line)) == "dateinvoice") {

                $dateInvoice = str_replace("\t", '', $text[$key+1]);
                $data['invoice_date'] = substr($dateInvoice, 0, 10);
                $data['invoice_number'] = substr($dateInvoice, 10);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 26) == 'totalproducts&othercharges') {

                $data['total_products_and_other_charges'] = substr($line, 31);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 15) == 'invoicesubtotal') {

                $data['invoice_sub_total'] = substr($line, 18);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 8) == 'salestax') {

                $data['sales_tax'] = substr($line, 11);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 12) == 'invoicetotal') {

                $data['invoice_total'] = substr($line, 15);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 8) == 'payments') {

                $data['payments'] = substr($line, 10);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 7) == 'credits') {

                $data['credits'] = substr($line, 9);

            } else if (substr(strtolower(str_replace(' ', '', $line)), 0, 10) == 'balancedue') {

                $data['balance_due'] = substr($line, 13);
            }

        }

        dd($data);
    }
}





