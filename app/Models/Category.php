<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens;
    protected $fillable = [
        "name",
        "status",
    ];

    // relationship to news
    public function news ()
    {
        return $this->hasMany(News::class);
    }
}
