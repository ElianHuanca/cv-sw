<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Sucursales;
use App\Models\Trabajos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrabajosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();
        if ($usuario->rol == 'Postulante') {
            $trabajos = Trabajos::where('estado', true)
                ->whereNotIn('id', function ($query) use ($usuario) {
                    $query->select('idtrabajo')->from('postulaciones')->where('iduser', $usuario->id);
                })
                ->orderBy('idarea', 'desc')
                ->paginate(10);
            $areas = Areas::all();
            //dd($trabajos);
            return view('trabajos.index', compact('trabajos', 'areas'));
        } else {
            $trabajos = Trabajos::orderBy('estado', 'desc')->orderBy('idarea', 'desc')->paginate(10);
            return view('trabajos.index', compact('trabajos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $sucursales = Sucursales::where('idempresa', $user->idempresa)->get();
        $areas = Areas::all();
        return view('trabajos.create', compact('sucursales', 'areas'));
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
            'idarea' => 'required'
        ]);
        $user = auth()->user();
        $responsabilidades = explode("\n", str_replace(["\r"], "", $request->responsabilidades));
        $requisitos = explode("\n", str_replace(["\r"], "", $request->requisitos));
        //$requisitos = array_filter($requisitos, 'strlen');

        // Inserta el array en la base de datos        
        //$responsabilidades = ['Desarrollo y mantenimiento de aplicaciones', 'Conocimiento de varios lenguajes de programación'];
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
            'idarea' => $request->idarea,
            'iduser' => $user->id,
            'idsucursal' => $request->idsucursal,
        ]);



        return redirect()->route('trabajos.index')->with('success', 'Trabajo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trabajo = Trabajos::where('id', $id)->first();
        return view('trabajos.show', compact('trabajo'));
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
    public function showEmpresas()
    {
        $user = Auth::user();
        $trabajos = Trabajos::where('idempresa', $user->idempresa)->paginate(10);
        return view('trabajos.getTrabajos', compact('trabajos'));
    }
    public function EliminarEmpresa($idempresa)
    {
        $trabajo = Trabajos::where('id', $idempresa)->first();
        $trabajo->estado = false;
        $trabajo->save();
        return redirect()->route('trabajos.index')->with('success', 'Trabajo eliminado correctamente');
    }
}
