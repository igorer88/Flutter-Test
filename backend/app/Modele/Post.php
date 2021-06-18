<?php

namespace App\Modele;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'post_type',
        'author_id',
        'category_id',
        'meta_data',
    ];


    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Modele\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Modele\Image');
    }

    public function videos()
    {
        return $this->hasMany('App\Modele\Video');
    }

    public function comments()
    {
        return $this->hasMany('App\Modele\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Modele\Tag');
    }
    public function link()
    {
        return '/posts/' . $this->id;
    }
}
