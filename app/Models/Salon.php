<?php

namespace App\Models;

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
}
