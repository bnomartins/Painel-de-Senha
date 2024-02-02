<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IdentificacaoEstoque extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function estoque(): HasMany
    {
        return $this->hasMany(Estoque::class);
    }

    public function usuario(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'rel_est_users')->withPivot(['acesso']);;
    }
}
