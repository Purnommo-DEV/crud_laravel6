<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        //metode cek apakah kata kunciny ada
        //metode HAS -> cek queri string itu ada
        if($request->has('cari')){
            //jika ada queri Cari itu maka ambil data tersbut
            // :: tanda queri builder
            $data_siswa = \App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->paginate(20);
        }else{
        //siswa = nama Folder
        //index = nama file

        //buat variabel baru = NamespaceModel\ClassSiswaModel dn ambil seluruh data 
        //Data Siswa semuanya akan di isikan ke variabel $data_siswa
        $data_siswa = \App\Siswa::paginate(20);
        }
        //Kemudian $data_siswa ini akan kita arahkan ke file VIEW
        return view('siswa.index', ['data_siswa'=> $data_siswa]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_depan'    =>'required|min:5',
            'nama_belakang' =>'required',
            'email'         =>'required|email|unique:users',
            'jenis_kelamin' =>'required',
            'agama'         =>'required',
            'avatar'        =>'mimes:jpeg,png',
            ]);

        //Insert ke table User
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60);
        $user->save();

        //Insert ke table Siswa
        $request->request->add(['user_id' => $user->id ]);
        $siswa = \App\Siswa::create($request->all());
        if($request->hasFile('avatar')) //Cek apakah ada file avatar yang di Upload 
        {
            // jika ada gambar, MOVE ke folder IMAGES dan simpan nama gambarnya dengan NAMA ORIGINAL 
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            //Kemudia simpan ke database
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        //Jika berhasil menambah data, maka halaman akan kembali ke halaman Siswa
        //Widht itu adalah Flash Message
        return redirect('/siswa')->with('sukses','Data berhasil diinput');
    }

    public function edit($id)
    {
        //variabel baru = NamespaceModel\ClassSiswaModel find(sebutkan) $id nya
        $siswa= \App\Siswa::find($id);
        //Passing Data ['siswa'=> $siswa]
        //Gunanya agar data di database bisa dibaca pada form Edit
        return view('siswa/edit',['siswa'=> $siswa]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $siswa= \App\Siswa::find($id); //Mengambil data siswa dengan ID yang ada di parameter ....., $id
        $siswa->update($request->all()); //Mengambil data dari request
        if($request->hasFile('avatar')) //Cek apakah ada file avatar yang di Upload 
        {
            // jika ada MOVE gambar ke folder IMAGES dan simpan nama gambarnya dengan NAMA ORIGINAL 
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            //Kemudia simpan ke database
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data Berhasil d update');
    }

    public function delete($id)//Langsung di arahkan ke ID (HAPUS)
    {
        $siswa= \App\Siswa::find($id);
        $siswa->delete($siswa);
        return redirect('/siswa')->with('sukses','Data berhasil dihapus');
    }

    public function profil($id)
    {
        //buat variabel baru = NamespaceModel\ClassSiswaModel dn ambil seluruh data 
        //Data Siswa semuanya akan di isikan ke variabel $data_siswa
        $siswa = \App\Siswa::find($id);
        $matapelajaran = \App\Mapel::all();
        
        //Menyiapkan data untuk Chart
        $categories = [];
        $data=[];
        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
            $categories[] = $mp->nama;
            $data[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
        }
    }
        //Kemudian $data_siswa ini akan kita arahkan ke file VIEW
        return view('siswa.profil', ['siswa'=> $siswa,'matapelajaran'=> $matapelajaran, 'categories'=>$categories, 'data'=>$data]);
    }

    public function addnilai(Request $request, $idsiswa)
    {
        //dd($request->all());
        $siswa = \App\Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profil')->with('error','Data sudah ada');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);
        return redirect('siswa/'.$idsiswa.'/profil')->with('sukses','Data berhasil dimasukkan');
    }

    public function deletenilai($idsiswa,$idmapel)
    {
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses','Data nilai berhasil dihapus');
    }

    public function exportExel() 
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }
}
