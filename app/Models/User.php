<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Roles;
use Laravel\Sanctum\HasApiTokens;
use App\Providers\RoleServiceProvider;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'email',
        'password',
        'date_naissance',
        'adresse',
        'telephone',
        'photo_profil',
        'numero_permis',
        'numero_voiture',
        'couleur_voiture',
        'role',
        'photo_permis',
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



    public function role(): BelongsTo
    {
        return $this->belongsTo(Roles::class);
    }



    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }


    public static function isAdmin($user): bool
    {
        return $user->role->libelle === RoleServiceProvider::ADMIN;
    }

    public static function isSuperAdmin($user): bool
    {
        return $user->role->libelle === RoleServiceProvider::SUPER_ADMIN;
    }


    public static function isConducteur($user): bool
    {
        return $user->role->libelle === RoleServiceProvider::CONDUCTEUR;
    }

    public static function isPassager($user): bool
    {
        return $user->role->libelle === RoleServiceProvider::PASSAGER;
    }
}
