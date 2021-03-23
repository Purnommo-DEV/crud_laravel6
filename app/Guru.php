<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table ='guru';
    protected $fillable = ['nama', 'telepon', 'alamat'];

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
        //Satu guru punya banyak mapel
        return $this->hasMany(Mapel::class);
    }
}
