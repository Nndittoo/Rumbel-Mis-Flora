<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'materi_id',
        'comment'
    ];

    public function commentUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commentMateri(){
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
