<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cid1 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function procedimentos(){
        return $this->belongsTo(Procedimento::class, 'procedimento', 'codigo');
    }
}
