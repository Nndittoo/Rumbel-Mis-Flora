<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

// class User extends Authenticatable implements FilamentUser
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_PENGAJAR = 'PENGAJAR';
    const ROLE_ORANGTUA = 'ORANGTUA';
    const ROLE_SISWA = 'ADMIN';

    const ROLES = [
        self::ROLE_PENGAJAR => 'Pengajar',
        self::ROLE_ORANGTUA => 'Orangtua',
        self::ROLE_SISWA => 'Siswa',
        self::ROLE_ADMIN => 'Admin',
    ];

    // public function canAccessPanel(Panel $panel): bool{
    //     return $this->isAdmin() || $this->isPengajar();
    // }

    // public function isAdmin(){
    //     $this->role === self::ROLE_ADMIN;
    // }

    // public function isPengajar(){
    //     $this->role === self::ROLE_PENGAJAR;
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
