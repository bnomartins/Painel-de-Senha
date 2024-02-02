<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExameAux extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function exames(){
        return $this->hasMany(Exame::class, 'id', 'exame_aux_id');
    }

}
