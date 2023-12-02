<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Textract\TextractClient;

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
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );

        $s3 = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
        $textract = new TextractClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
 
        $s3->putObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $request->file,
            'Body' => $request->file,
            'ACL' => 'public-read', 
        ]);
        $result = $textract->startDocumentTextDetection([
            'DocumentLocation' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' => $request->file,
                ],
            ],
        ]);
        // $jobId = $result['JobId'];

        // $textract->waitUntil('DocumentTextDetectionComplete', [
        //     'JobId' => $jobId,
        // ]);
    
        // // Obtener los resultados
        // $response = $textract->getDocumentTextDetection([
        //     'JobId' => $jobId,
        // ]);

        // $textExtracted = '';

        // foreach ($response['Blocks'] as $block) {
        //     if ($block['BlockType'] == 'LINE') {
        //         $textExtracted .= $block['Text'] . "\n";
        //     }
        // }
        
        // dd($textExtracted);


        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user); 
        return redirect('/dashboard');
    }

    public function createEmpresa()
    {
        return view('session.register-empresa');
    }

    public function storeEmpresa()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );

        

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user); 
        return redirect('/dashboard');
    }

}
