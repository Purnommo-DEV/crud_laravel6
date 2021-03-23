<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    //untuk file created_at akan dimasukkan ke variabel $date
    protected $date = ['created_at'];
    protected $fillable = ['title','content','thumbnail','slug','user_id'];
    
        /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function getAvatar()
    {
        
        if(!$this->avatar) //Jika avatarnya tidak ada,
        {
            return asset('images/default.jpg'); //Maka tampilkan Avatar/Foto DEFAULT
        }
            return asset('images/'.$this->avatar); //Jika ada maka tampilkan Foto sesuai Upload User
    }
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function user()
    {
        //Post dimiliki user
        return $this->belongsTo(User::class);
    }
    
    public function thumbnail()
    {
        
        if(!$this->avatar) //Jika avatarnya tidak ada,
        {
            return asset('images/default.jpg'); //Maka tampilkan Avatar/Foto DEFAULT
        }
            return asset('images/'.$this->avatar); //Jika ada maka tampilkan Foto sesuai Upload User
    }

}
