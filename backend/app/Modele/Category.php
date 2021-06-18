<?php

namespace App\Modele;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'color'
    ];

    public function posts()
    {
        return $this->hasMany('App\Modele\Post');
    }
}
