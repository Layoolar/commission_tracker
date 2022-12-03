<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;
    public $table = 'user_category';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
