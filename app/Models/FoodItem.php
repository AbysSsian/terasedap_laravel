<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = ['name', 'price', 'category', 'description', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
    }

    use HasFactory;
}
