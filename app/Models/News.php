<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class News extends Model
{
//    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory, HasApiTokens;

    protected $fillable = [
        "title",
        "description",
        "image",
        "status",
        "slug",
        "image_logo",
        "title_logo"
    ];

    // relationship to category
//    public function category (){
//        return $this->belongsTo(Category::class);
//    }

    protected function  casts (): array
    {
        return [
            "created_at" => "datetime: d-m-Y",
            "updated_at" => "datetime: d-m-Y",
        ];
    }
}
