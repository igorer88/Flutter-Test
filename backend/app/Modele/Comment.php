<?php

namespace App\Modele;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','author_id','post_id','update_at',
    ];

    public function author(){
        return $this->belongsTo('App\User','author_id','id');
    }

    public function post(){
        return $this->belongsTo('App\Modele\Post');
    }
}
