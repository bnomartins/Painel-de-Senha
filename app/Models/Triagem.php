<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Triagem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function atendimento(): HasOne
    {
        return $this->hasOne(Atendimento::class, 'atendimento_id', 'id');
    }

    function risco(){
        return $this->belongsTo(Risco::class);
    }
}
