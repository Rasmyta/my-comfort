<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'time', 'salon_id', 'user_id'
    ];

    public function getSalon()
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getServices()
    {
        return $this->belongsToMany(Service::class, 'reservation_service', 'reservation_id', 'service_id');
    }

    public function getTotalTime()
    {
        $result = 0;
        foreach ($this->getServices as $service) {
            $result += $service->duration;
        }
        return $result;
    }
}
