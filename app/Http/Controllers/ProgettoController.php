<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use Illuminate\Http\Request;

class ProgettoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = [
            ['label' => 'CHI SIAMO', 'class' => 'page-scroll', 'href' => '#service'],
            ['label' => 'TOP 5', 'class' => 'page-scroll', 'href' => '#testimonial'],
            ['label' => 'LOG IN', 'class' => 'nav-link', 'href' => ""]
        ];

        return view('home', compact('nav'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function show(Progetto $progetto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function edit(Progetto $progetto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progetto $progetto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progetto $progetto)
    {
        //
    }
}
