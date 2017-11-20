<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SoapBox\Formatter\Formatter;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $destinationPath = public_path('/images');

//        $request->file('file')->move($destinationPath, $filename);

//        $full_file_name =  $destinationPath . '/' . $filename;
//        $file = Storage::get($filename);



//        $f = Storage::disk('local');
//        $files = $f->allFiles();
//        $contents = Storage::get('photo_2017-03-23_13-54-37.jpg');
//        $url = Storage::disk('public')->get($filename);
//        echo asset($url);
//        dd($url);
//        return dd( $response = Response::make($full_file_name, 200));

        $filename = $request->file('file')->getClientOriginalName();
        $file = $request->file('file');
        Storage::disk('public')->put($filename,File::get($file), 'public');
        $test = Storage::disk('public')->url($filename);
//        $test = Storage::disk('public')->publicUrl($filename);
        $test = Storage::url($filename);
//        $url = Storage::disk('public')->get($filename);
//        $path = $request->file('file')->store('public');
        echo asset($test);
        dd($test);
//        $formatter = Formatter::make($url, Formatter::XML)->toJson();
//        header('Content-Disposition: attachment; filename="test.json"');
//        header("Cache-control: private");
//        header('Content-Type: application/json');
//        header("Content-transfer-encoding: binary\n");
//        return response()->download();
//        echo '<pre>'; print_r($formatter);echo '</pre>';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
