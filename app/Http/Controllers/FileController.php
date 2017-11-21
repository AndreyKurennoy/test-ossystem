<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapBox\Formatter\Formatter;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Stores the content of the formatted file
     * @var
     */
    public $content;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Getting all necessary data about file and convert format
        $filename = $request->file('file')->getClientOriginalName();
        $extension = strtolower($request->file('file')->getClientOriginalExtension());
        $filename = str_replace($extension,'',$filename);
        $file = $request->file('file');
        $file_content = file_get_contents($file->getRealPath());
        $format = $request->get('format');

        $this->convert($format, $extension, $file_content);

        //Save this file in storage
        Storage::disk('public')->put($filename . $format, $this->content, 'public');
        //Getting public link to file
        $url = asset(Storage::url($filename . $format));

        return response($url);
    }

    /**
     * @param $format
     * @param $extension
     * @param $file_content
     */
    public function convert($format, $extension, $file_content){
        //Processing the file to get desired format
        switch ($format){
            case 'xml':
                if ($extension == 'json'){
                    $this->content = Formatter::make($file_content, Formatter::JSON)->toXml();
                }elseif($extension == 'csv'){
                    $this->content = Formatter::make($file_content, Formatter::CSV)->toXml();
                }elseif($extension == 'yaml'){
                    $this->content = Formatter::make($file_content, Formatter::YAML)->toXml();
                }
                break;
            case 'json':
                if ($extension == 'xml'){
                    $this->content = Formatter::make($file_content, Formatter::XML)->toJson();
                }elseif($extension == 'csv'){
                    $this->content = Formatter::make($file_content, Formatter::CSV)->toJson();
                }elseif($extension == 'yaml'){
                    $this->content = Formatter::make($file_content, Formatter::YAML)->toJson();
                }
                break;
            case 'csv':
                if ($extension == 'xml'){
                    $this->content = Formatter::make($file_content, Formatter::XML)->toCsv();
                }elseif($extension == 'json'){
                    $this->content = Formatter::make($file_content, Formatter::JSON)->toCsv();
                }elseif($extension == 'yaml'){
                    $this->content = Formatter::make($file_content, Formatter::YAML)->toCsv();
                }
                break;
            case 'yaml':
                if ($extension == 'json'){
                    $this->content = Formatter::make($file_content, Formatter::JSON)->toYaml();
                }elseif($extension == 'csv'){
                    $this->content = Formatter::make($file_content, Formatter::CSV)->toYaml();
                }elseif($extension == 'xml'){
                    $this->content = Formatter::make($file_content, Formatter::XML)->toYaml();
                }
                break;
        }
    }

}
