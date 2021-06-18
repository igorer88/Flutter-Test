<?php

namespace App\Modele;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description','url','post_id','featured',
    ];


    public function post()
    {
        return $this->belongsTo('App\Modele\Post');
    }

    public function getImageUrlAttribute($value)
    {
        return (strpos($this->url, 'http') === 0) ? $this->url : Storage::get($this->url);
    }

}
