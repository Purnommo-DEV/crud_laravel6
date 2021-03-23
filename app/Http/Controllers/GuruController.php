<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;

class GuruController extends Controller
{
    public function profil($id)
    {
        $guru = \App\Guru::find($id);
        return view('/guru.profile',['guru'=>$guru]);
    }
}
