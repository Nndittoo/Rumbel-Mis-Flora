<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tugas_id',
        'note',
        'tanggal',
        'balas'
    ];


    public function balasTugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function balasUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
