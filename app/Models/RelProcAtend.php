<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelProcAtend extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user_solicitacao(){
        return $this->belongsTo(User::class);
    }

    public function user_atendimento(){
        return $this->belongsTo(User::class);
    }

    public function atendimentos(){
        return $this->belongsTo(Atendimento::class, 'atendimento_id', 'id');
    }
}
