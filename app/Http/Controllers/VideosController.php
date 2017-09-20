<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Video;
use App\Category;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\CreateVideoRequest;
use Auth;
use Session;


class VideosController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['only' => 'create']);
    }


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
        $categories = Category::pluck('name', 'id');
        return view('videos.create')->with('categories', $categories);
    }  


    // zapis filmu
    public function store(CreateVideoRequest $request) {
        $video =  new Video($request->all());
        Auth::user()->videos()->save($video);

        $categoryIds = $request->input('CategoryList');
        $video->categories()->attach($categoryIds);

        Session::flash('video_created', 'Twój film został zapisany');
        return redirect('videos');
    }  


    // edycja filmu
    public function edit($id) {
        $video = Video::findOrFail($id);

        $categories = Category::pluck('name', 'id');

        return view('videos.edit', compact('video', 'categories'));
    }


    // update filmu
    public function update($id, CreateVideoRequest $request) {
        $video = Video::findOrFail($id);
        $video->update($request->all());
        $video->categories()->sync($request->input('CategoryList'));
        return redirect('videos');
    }
}
