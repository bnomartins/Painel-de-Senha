<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    //
    protected $guarded = ['id'];

    public function atendimento(){
        return $this->belongsTo(Atendimento::class);
    }

}
