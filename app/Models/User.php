<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'email',
        'password',
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

    public function listUnits(): HasMany
    {
        return $this->hasMany(ListUnit::class);
    }

    public function sharedListUnitsByMe()
    {
        return $this->belongsToMany(ListUnit::class,'shared_list_unit', 'shared_by')
            ->withPivot('shared_with')
            ->using(SharedListUnit::class);
    }

    public function sharedListUnitsWithMe()
    {
        return $this->belongsToMany(ListUnit::class,'shared_list_unit', 'shared_with')
            ->withPivot('shared_by')
            ->using(SharedListUnit::class);
    }
}
