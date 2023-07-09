<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Gimnasios;
use Illuminate\Http\Request;
use App\Http\Resources\V1\GimnasioResource;
use App\Http\Resources\V1\GimnasioCollection;

class GimnasiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new GimnasioCollection(Gimnasios::latest()->paginate());
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
     * @param  \App\Models\Gimnasios  $gimnasios
     * @return \Illuminate\Http\Response
     */
    public function show(Gimnasios $gimnasios)
    {
        //
        return new GimnasioResource($gimnasios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gimnasios  $gimnasios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gimnasios $gimnasios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gimnasios  $gimnasios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gimnasios $gimnasios)
    {
        //
    }
}
