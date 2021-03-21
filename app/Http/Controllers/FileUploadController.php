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


    public function comcast(Request $req) 
    {
        $data = [
            'formHeading' => 'Comcast Business Invoice Upload',
            'formAction' => '/pdf-upload/comcast',
        ];
        return view('fileUpload', $data);
    }


    private function contains($line, $word)
    {
        $line = str_replace(' ', '', $line);
        return stripos($line, $word);
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
}





