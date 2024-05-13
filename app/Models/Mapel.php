<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'slug',
        'image',
        'text_color',
        'bg_color',
    ];

    public function mapelMateri(){
        return $this->belongsToMany(Materi::class);
    }
}
