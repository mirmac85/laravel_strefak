<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about() {
       return view('pages.about');
    }
    
    public function contact() {
       $header = 'naglowek';
       $date = '2432342';
       return view ('pages.contact', compact('header', 'date'));
    }
}
