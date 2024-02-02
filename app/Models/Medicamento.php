<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function procedimento(){
        return $this->belongsTo(Procedimento::class);
    }

    public function ambulatorio(){
        return $this->belongsTo(Ambulatorio::class);
    }
}
