<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory;
    use SoftDeletes;

    const Monday = 'Monday';
    const Thuesday = 'Thuesday';
    const Wednesday = 'Wednesday';
    const Thursday = 'Thursday';
    const Friday = 'Friday';
    const Saturday = 'Saturday';

    const DAY = [
        self::Monday => 'Monday',
        self::Thuesday => 'Thuesday',
        self::Wednesday => 'Wednesday',
        self::Thursday => 'Thursday',
        self::Friday => 'Friday',
        self::Saturday => 'Saturday',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'jadwal',
        'kelas_mulai',
        'kelas_akhir',
        'text_color',
        'bg_color',
    ];

    public function mapelMateri(){
        return $this->belongsToMany(Materi::class);
    }
}
