<?php

namespace App\Http\Controllers;

use App\Language;
use File;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages= Language::get();
        return view('language.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $request->validate([
            'name' => 'required',
            'image' => 'required',
            'direction' => 'required',
            'json_file' => 'required'
        ]);
       
        $lng= new Language;
        $lng->name=$request->name;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $fileName = $request->name;
            $path = public_path('upload/');
            $file->move($path, $fileName.".png");
            $lng->image = $fileName.".png";
        }
        
        if ($file = $request->hasfile('json_file'))
        {
            $file = $request->file('json_file');
            $fileName = $request->name;
            $path = resource_path('/lang');
            $file->move($path, $fileName.'.json');
            $lng['json_file'] = $fileName.".json";
        }
       $lng->direction=$request->direction;
       $lng->status=$request->status;
       $lng->save();
       return redirect('/languages')->with('status','Successful Added');
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
        $languages= Language::find($id);
        return view('language.edit',compact('languages'));
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
        $lng =Language::find($request->id);
        $lng->name=$request->name;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $fileName = $request->name;
            $path = public_path('upload/');
            $file->move($path, $fileName.".png");
            $lng->image = $fileName.".png";
        }
        
        if ($file = $request->hasfile('json_file'))
        {
            $file = $request->file('json_file');
            $fileName = $request->name;
            $path = resource_path('/lang');
            $file->move($path, $fileName.'.json');
            $lng['json_file'] = $fileName.".json";
        }
       $lng->direction=$request->direction;
       $lng->status=$request->status;
       $lng->update();
       return redirect('/languages')->with('status','Successful Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language=Language::find($id);
        if(File::exists(resource_path('lang/'.$language->json_file))){
            File::delete(resource_path('lang/'.$language->json_file));
        }
        $language->delete();
        return redirect('/languages')->with('status','Successful deleted');
    }

    public function SelectLanguage($id)
    { 
        $lng=Language::find($id);
        \App::setLocale($lng->name);
        session()->put('locale', $lng->name);
        $direction = $lng->direction;
        session()->put('direction', $direction);
        $image=$lng->image;
        session()->put('lngimage',$image);
        return redirect()->back();
        
    }
    public function sampleDownload()
    {
        $myFile=resource_path('/lang/english.json');
    	return response()->download($myFile);
    }
}
