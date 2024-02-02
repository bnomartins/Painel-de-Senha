<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'room',
        'email',
        'password',
        'access',
        'user_id',
        'service',
        'sector'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pacientes()
    {
        return $this->hasMany(Atendimento::class);
    }

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }

    public function triagems()
    {
        return $this->hasMany(Triagem::class);
    }

    public function clinicos()
    {
        return $this->hasMany(Clinico::class);
    }

    public function ambulatorios()
    {
        return $this->hasMany(Ambulatorio::class);
    }

    public function exames()
    {
        return $this->hasMany(Exame::class);
    }
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
    public function unidades()
    {
        return $this->belongsToMany(Unidade::class,  RelUnidServ::class)->withPivot('user_id');
    }
    public function servicos()
    {
        return $this->belongsToMany(Servico::class,  RelUnidServ::class)->withPivot('user_id');
    }
    public function prestador()
    {
        return $this->hasMany(Prestador::class);
    }
    public function estoque(): BelongsTo
    {
        return $this->belongsTo(Estoque::class);
    }
    public function identificacaoEstoque(): BelongsToMany
    {
        return $this->belongsToMany(IdentificacaoEstoque::class, 'rel_est_users')->withPivot(['acesso']);
    }

}
