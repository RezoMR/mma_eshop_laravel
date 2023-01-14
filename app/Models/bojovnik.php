<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bojovnik extends Model
{
    use HasFactory;


    protected $fillable = [
        'name','vyhry', 'prehry',
    ];
    public $timestamps = false;
}
