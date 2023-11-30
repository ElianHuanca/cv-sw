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
        $trabajos = Trabajos::where('estado', true)->get(); //->paginate(10);
        dd($trabajos);
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

        
        $cadenaResponsabilidades = "'" . str_replace("\n", "', '", $request->responsabilidades) . "'";
        $cadenaRequisitos = "'" . str_replace("\n", "', '", $request->requisitos) . "'";


        // Inserta el array en la base de datos
        DB::insert(`INSERT INTO trabajos (cargo,
        responsabilidades,
        requisitos,
        salario,
        vacancia,
        fechafin,
        idempresa,
        idsucursal) VALUES ('$request->cargo', 
        ARRAY[$cadenaResponsabilidades], 
        ARRAY[$cadenaRequisitos],
        '$request->salario',
        '$request->vacancia',
        '$request->fechafin',
        '$user->idempresa',
        '$request->idsucursal'
        )`);



        /* Trabajos::create([
            'cargo' => $request->cargo,
            'responsabilidades' => $pgArrayResponsabilidades,
            'requisitos' => $pgArrayRequisitos,
            'salario' => $request->salario,
            'vacancia' => $request->vacancia,
            'fechafin' => $request->fechafin,
            'idempresa' => $user->idempresa,
            'idsucursal' => $request->idsucursal,
        ]); */
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
