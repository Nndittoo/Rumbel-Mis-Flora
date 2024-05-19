<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Ortu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fullName',
        'alamat',
        'noHp'
    ];

    public function ortuUser()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function ortuSiswa(){
    return $this->belongsToMany(Siswa::class);
}

public function scopeOrtuRole(Builder $query)
{
    return $query->whereHas('role', function ($query) {
        $query->where('name', 'ortu');
    });
}

public function scopeWithoutOrtuUser(Builder $query)
    {
        return $query->doesntHave('ortuUser');
    }
}
