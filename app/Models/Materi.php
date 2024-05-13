<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'body',
        'title',
        'slug',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query){
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeMapel($query, string $mapel){
            $query->whereHas('materiMapel', function ($query)  use ($mapel){
            $query->where('slug', $mapel);
        });
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function materiMapel(){
        return $this->belongsToMany(Mapel::class);
    }

    public function getExcerpt(){
        return Str::limit(strip_tags($this->body), 100);
    }

    protected $cast = [
        'published_at' => 'datetime',
    ];
}
