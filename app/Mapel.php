<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['kode','nama','semester'];

    public function siswa()
    {
    return $this->belongsToMany(Siswa::class)->withPivot(['nilai']);   
    }
    
    public function guru()
    {
        //1 mapel dimiliki oleh 1 guru
        return $this->belongsTo(Guru::class);
    }
}