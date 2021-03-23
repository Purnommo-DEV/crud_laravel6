<?php
// Folder Helpers dan File Global.php kita membuat sendiri
// Dengan menggunakan Global.php ini nantinya function dapat di panggil di berbgai folder
use \App\Siswa;
use \App\Guru;

function rangking5Besar()
{
       //dashboard itu folder
        //index itu file yang ada di dalam Folder Dashboard
        //Menambahkan field baru dengan nama rataRataNilai di tabel "siswa dan memanggil funktion rataRataNilai pada model Siswa
        //$s artinya 1 siswa
        //
        $siswa = \App\Siswa::all();
        $siswa->map(function($s){
            // Membuat properti rengan nma rataRataNilai = memasukkan hasil dari function rataRataNilai ke variabel $s
            $s -> rataRataNilai = $s->rataRataNilai();
            return $s;
        });
        //Pengurutan Nilai berdasarkan properti yaitu rataRataNilai
        //take(5) Menampilkan 5 Data
        $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
        return $siswa;
}

function totalSiswa()
{
    //return Panggil Modelnya yaitu Siswa
    return Siswa::count();
}

function totalGuru()
{
    //return Panggil Modelnya yaitu Guru
    return Guru::count();
}

function getAvatar()
{
    return Siswa::count();
}