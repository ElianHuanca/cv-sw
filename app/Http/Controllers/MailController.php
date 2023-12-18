<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function postMail($id){
        Mail::to('huancacori@gmail.com')->send(new TestMail($id));
    }
}
