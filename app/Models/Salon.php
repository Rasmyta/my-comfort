<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'employees', 'address', 'city', 'postal_code', 'description'
    ];

    public function getServices()
    {
        return $this->hasMany(Service::class);
    }

    public function getImages()
    {
        return $this->hasMany(SalonImage::class);
    }

    public function getManager()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTimetable()
    {
        return $this->belongsTo(Timetable::class, 'timetable_id');
    }

    public function getActivity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public static function salonsByCategory($categoryId)
    {
        return DB::table('salons')
            ->join('services', 'salons.id', '=', 'services.salon_id')
            ->select('salons.*')
            ->groupBy('salons.id', 'category_id')
            ->having('category_id', $categoryId)
            ->get();
    }
}
