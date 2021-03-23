<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];

    public function getAvatar()
    {
        
        if(!$this->avatar) //Jika avatarnya tidak ada,
        {
            return asset('images/default.jpg'); //Maka tampilkan Avatar/Foto DEFAULT
        }
            return asset('images/'.$this->avatar); //Jika ada maka tampilkan Foto sesuai Upload User
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai']);
    }

    public function rataRataNilai()
    {
        $total = 0;
        $hitung = 0;
        foreach($this->mapel as $mapel){
            $total += $mapel->pivot->nilai;
            $hitung++;
        }
        //Solusi jika jumpe error Division Zero
        if($total>0 && $hitung>0){
            return round($total/$hitung);
        }
        else{
            return('Tidak ada Nilai');
        }
    }

    public function nama_lengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }
    
}
