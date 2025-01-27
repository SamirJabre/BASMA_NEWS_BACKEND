<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'body',
        'image',
    ];
    public function clicks()
    {
        return $this->hasMany(ClickLog::class, 'category_id');
    }
}
