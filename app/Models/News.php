<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    use Sluggable;   
    protected $fillable = [
        'title', 'slug', 'description', 'cover_image', 'publisher_id', 'publisher_name', 'church_id', 'church_name'
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function publisher(){
        return $this->belongsTo(Church::class);
    }
 
}
