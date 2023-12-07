<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cantTrabXCiu = DB::table('sucursales')
        ->join('trabajos', 'sucursales.id', '=', 'trabajos.idsucursal')
        ->where('trabajos.idempresa', 1)  // Reemplaza 1 con el ID de la empresa específica
        //->where('trabajos.estado', true)
        ->groupBy('sucursales.ciudad','trabajos.estado')
        ->orderBy('sucursales.ciudad')
        ->select('sucursales.ciudad','trabajos.estado', DB::raw('COUNT(trabajos.id) as cantidad_trabajos'))
        ->get();
        //dd($cantTrabXCiu);
        return view('dashboard', compact('cantTrabXCiu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
