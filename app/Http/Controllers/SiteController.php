<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;


class SiteController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        //Menampilkan file Home yang ada di Folder Site
        return view('site.home', compact(['posts']));
    }

    public function about()
    {
        return view('site.about');
    }

    public function register()
    {
        return view('site.register');
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug','=',$slug)->first();
        return view('site.singlepost', compact(['post']));
    }
    
    public function postregister(Request $request)
    {
        //$request maksudnya Inputan User atau permintaan user
        //Insert ke table User
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id ]);
        $siswa = \App\Siswa::create($request->all());

        return redirect('/')->with('sukses','Pendaftaran Berhasil');
    }
}
