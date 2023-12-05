<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use App\Models\Trabajos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$user = auth()->user();
        $trabajos = Trabajos::where('estado', true)->paginate(10);
        //$trabajo = Trabajos::where('id', 7)->first();
        //dd($trabajo);
        return view('trabajos.index', compact('trabajos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $sucursales = Sucursales::where('idempresa', $user->idempresa)->get();
        return view('trabajos.create', compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //realizar validaciones
        $request->validate([
            'cargo' => 'required',
            'responsabilidades' => 'required',
            'requisitos' => 'required',
            'salario' => 'required',
            'vacancia' => 'required',
            'fechafin' => 'required',
            'idsucursal' => 'required',
        ]);
        //dd($request->all());
        $user = auth()->user();
        
        
        /* $responsabilidades = "'".str_replace(["\n"], "','" ,$request->responsabilidades)."'";
        $responsabilidades = [str_replace(["\r"], '', $responsabilidades)]; */


        //$responsabilidades = explode("\n", str_replace(["\r"], "", $request->responsabilidades));
        //dd($responsabilidades);
        //$responsabilidades = array_filter($responsabilidades, 'strlen');
        //$responsabilidades = array_values($responsabilidades);
        
        $requisitos = explode("\n", str_replace(["\r"], "", $request->requisitos));
        //$requisitos = array_filter($requisitos, 'strlen');

        // Inserta el array en la base de datos        
        $responsabilidades = ['Desarrollo y mantenimiento de aplicaciones', 'Conocimiento de varios lenguajes de programación'];
        //dd($responsabilidades);
        DB::table('trabajos')->insert([
            'cargo' => $request->cargo,
            'responsabilidades' => DB::raw('ARRAY[' . implode(',', array_map(function ($item) {
                return "'" . addslashes($item) . "'";
            }, $responsabilidades)) . ']'),            
            'requisitos' => DB::raw('ARRAY[' . implode(',', array_map(function ($item) {
                return "'" . addslashes($item) . "'";
            }, $requisitos)) . ']'),
            'salario' => $request->salario,
            'vacancia' => $request->vacancia,
            'fechafin' => $request->fechafin,
            //'categoria' => $request->categoria,
            'idempresa' => $user->idempresa,
            'idsucursal' => $request->idsucursal,
        ]);



        return redirect()->route('trabajos.index')->with('success', 'Trabajo creado correctamente');
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
