<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mapel_id',
        'title',
        'description',
        'file_path',
        'original_filename',
        'deadline'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'file_paths' => 'array',
    ];

    public function tugasMapel(){
        return $this->belongsTo(Mapel::class);
    }
    public function tugasUser(){
        return $this->belongsTo(User::class);
    }
}
