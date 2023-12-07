<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\User;
use Aws\Textract\TextractClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $empresa= Empresas::where('id', $user->idempresa)->first();
        $users= User::where('idempresa', $empresa->id)->get();
        return view('users.index', compact('users','empresa'));
    }
    public function gestionUsuarios(){
        $user = Auth::user();
        $empresa= Empresas::where('id', $user->idempresa)->first();
        $nombreEmpresa=$empresa->razon;
        $users= User::where('idempresa', $empresa->id)->get();
        return view('usuarios.gestionarUsuarios', compact('users','nombreEmpresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }
    public function agregarPersonal()
    {
        return view('usuarios.agregarPersonal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $userAdmin = Auth::user();
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password =bcrypt(($request->password));
            $user->phone=$request->phone;
            $user->location=$request->location;
            $user->about_me=$request->about_me;
            $empresa= Empresas::where('id', $userAdmin->idempresa)->first();
            $user->idempresa=$empresa->id;
            $user->rol="Personal";
            $user->url=$request->url;
            $user->save();
         
            $user = Auth::user();
            $empresa= Empresas::where('id', $user->idempresa)->first();
            $nombreEmpresa=$empresa->razon;
            $users= User::where('idempresa', $empresa->id)->get();
            return view('usuarios.gestionarUsuarios', compact('users','nombreEmpresa'));
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
