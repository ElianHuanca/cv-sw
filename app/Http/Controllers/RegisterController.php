<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Textract\TextractClient;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'celular' => ['required', 'min:8', 'max:8'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['rol'] = 'Postulante';

        $path = $request->file('file')->store('cv', 's3');
        $attributes['url'] = Storage::disk('s3')->url($path);
        $attributes['pathcv'] = $path;

        $textract = new TextractClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $result = $textract->detectDocumentText([
            'Document' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' =>$attributes['pathcv'], 
                ],
            ],
        ]);        
        $blocks = $result['Blocks'];
        $text = '';
        foreach ($blocks as $key => $value) {
            if ($value['BlockType'] == 'LINE' || $value['BlockType'] == 'WORD') {
                $text .= $value['Text'] . "\n";
            }
        }
        $attributes['textcv'] = $text;

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user);
        return view('laravel-examples/user-profile');//return redirect()->route('user-profile');//redirect('/perfil');
    }

    public function createEmpresa()
    {
        return view('session.register-empresa');
    }

    public function storeEmpresa(Request $request)
    {
        //dd($request->all());
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],            
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);

        Empresas::create([
            'razon' => $request->razon,
            'tipo' => 'Grande'
        ]);

        session()->flash('success', 'Your account has been created.');
        $user = User::create(
            [
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => $attributes['password'],
                'rol' => 'Personal',
                'idempresa' => Empresas::latest('id')->first()->id
            ]
        );
        Auth::login($user);
        return view('/laravel-examples/user-profile');
    }
}
