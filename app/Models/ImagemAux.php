<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemAux extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function imagems(){
        return $this->hasMany(Imagem::class, 'id', 'imagem_aux_id');
    }


}
