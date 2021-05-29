<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'salon_id'
    ];

    protected $table = 'salon_images';

    protected $primaryKey = 'path';

    public $incrementing = false;

    protected $keyType = 'string';

    public function getSalon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }
}
