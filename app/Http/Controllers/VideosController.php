<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\CreateVideoRequest;

class VideosController extends Controller
{

    // lista filmów
    public function index() {
       $videos = Video::latest()->get();
       return view('videos.index')->with('videos', $videos);
    }
    

    // jeden film
    public function show($id) {
       $video = Video::findOrFail($id);
       return view('videos.show')->with('video', $video);
    }


    // tworzenie filmu
    public function create() {
        return view('videos.create');
    }  


    // zapis filmu
    public function store(CreateVideoRequest $request) {
        Video::create($request->all());
        return redirect('videos');
    }  


    // edycja filmu
    public function edit($id) {
        $video = Video::findOrFail($id);
        return view('videos.edit')->with('video', $video);
    }


    // update filmu
    public function update($id, CreateVideoRequest $request) {
        $video = Video::findOrFail($id);
        $video->update($request->all());
        return redirect('videos');
    }
}
