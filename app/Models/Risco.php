<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risco extends Model
{
    use HasFactory;
    protected $guarde = ['id'];

    function triagem(){
        return $this->belongsTo(Triagem::class);
    }
}
