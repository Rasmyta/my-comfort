<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'duration', 'subcategory', 'description', 'price'
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSalon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }
}
