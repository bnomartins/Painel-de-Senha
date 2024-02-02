<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ambulatorio(){
        return $this->belongsTo(Ambulatorio::class);
    }

    public function exame(){
        return $this->belongsTo(Exame::class);
    }

    public function imagem(){
        return $this->belongsTo(Imagem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cid1(){
        return $this->belongsTo(Cid1::class);
    }

}
