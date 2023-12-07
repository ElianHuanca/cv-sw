<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=auth()->user();
        Sucursales::create(
            [                
                'direccion'=>$request->direccion,
                'latitud'=>$request->latitud,
                'longitud'=>$request->longitud,
                'ciudad'=>$request->ciudad,
                'idempresa'=>$user->idempresa,
            ]
        );
        return redirect()->route('empresas.index')->with('info', 'Sucursal creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sucursal=Sucursales::where('id',$id)->first();
        $sucursal->delete();
        return redirect()->route('empresas.index')->with('info', 'Sucursal eliminada con éxito');
    }
}
