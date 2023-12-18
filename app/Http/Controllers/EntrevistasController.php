<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Entrevistas;
use App\Models\Postulaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EntrevistasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->rol == 'Postulante'){
            $entrevistas = Entrevistas::join('postulaciones', 'entrevistas.idpostulacion', '=', 'postulaciones.id')
            ->join('users', 'postulaciones.iduser', '=', 'users.id')
            ->where('users.id', $user->id)            
            ->paginate(10);
            
        }else{
            $entrevistas = Entrevistas::where('iduser', $user->id)->paginate(10);

        }
        return view('entrevistas.index', compact('entrevistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $postulacion = Postulaciones::find($id);

        return view('entrevistas.create', compact('postulacion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $entrevista=Entrevistas::create(
            [
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                //'email' => $request->email,
                'idpostulacion' => $request->idpostulacion,
                'iduser' => $user->id,
            ]
        );

        Mail::to('huancacori@gmail.com')->send(new TestMail($entrevista->id));

        return redirect()->route('entrevistas.index')->with('success', 'Entrevista creada correctamente');
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
        $entrevista = Entrevistas::find($id);
        return view('entrevistas.edit', compact('entrevista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $entrevista = Entrevistas::find($id);
        $entrevista->update(
            [
                'resultado' => $request->resultado,
                'estado' => $request->estado,
            ]
        );

        if($request->estado == 'Aceptado'){
            $entrevista->postulacion->trabajo->vacante = -1;
            if($entrevista->postulacion->trabajo->vacante == 0){
                $entrevista->postulacion->trabajo->estado = false;
            }
            $entrevista->postulacion->trabajo->save();
        }
        return redirect()->route('entrevistas.index')->with('success', 'Entrevista actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
