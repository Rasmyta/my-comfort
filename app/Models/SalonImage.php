<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonImage extends Model
{
    use HasFactory;

    protected $table = 'salon_images';

    protected $primaryKey = 'path';

    public $incrementing = false;

    protected $keyType = 'string';
}
