<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'CHI SIAMO', 'class' => 'page-scroll', 'href' => '#service'],
            ['label' => 'TOP 5', 'class' => 'page-scroll', 'href' => '#testimonial'],
            ['label' => 'LOG IN', 'class' => 'nav-link', 'href' => "{{route('dashboard')}}"]
        ];

        return view('home', compact('nav'));
    }
}
