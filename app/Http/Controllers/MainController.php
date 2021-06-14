<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Role;
use App\Models\Salon;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use Log;

class MainController extends Controller
{

    public function createSalon()
    {
        return view('client.register-salon', ['activities' => Activity::all()]);
    }

    public function storeSalon(Request $request)
    {
        // to finish
        $validated = $request->validate([
            'name' => 'required',
            'cif' => 'required|size:9',
            'employees' => 'required|numeric',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required|numeric|min:5',
            'activity_id' => 'required|numeric',
            //user data
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['string', 'max:20'],
        ]);

        try {
            $user = new User;
            $user->name = $request->clientName;
            $user->surname = $request->clientSurname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = Role::where('name', 'manager')->first()->id;
            $user->save();

            Log::info("Usuario insertado");

            $salon = new Salon;
            $salon->name = $request->name;
            $salon->cif = $request->cif;
            $salon->employees = $request->employees;
            $salon->address = $request->address;
            $salon->city = $request->city;
            $salon->postal_code = $request->postal_code;
            $salon->activity_id = $request->activity_id;
            $salon->user_id = $user->id;
            $salon->save();

            // default timetable
            $timetableId = DB::table('timetables')->insertGetId([
                'monday_start' => '11:00',
                'monday_end' => '20:00',
                'tuesday_start' => '11:00',
                'tuesday_end' => '20:00',
                'wednesday_start' => '11:00',
                'wednesday_end' => '20:00',
                'thursday_start' => '11:00',
                'thursday_end' => '20:00',
                'friday_start' => '11:00',
                'friday_end' => '20:00',
                'saturday_start' => '11:00',
                'saturday_end' => '20:00',
                'salon_id' => $salon->id
            ]);

            $salon->timetable_id = $timetableId;
            $salon->save();

        } catch (Exception $e) {
            Log::error("Error en BD: " . $e->getMessage());
        }

        Log::info("Salon insertado");

        return redirect()->back()
            ->with('message', 'Gracias por elegir nosotros! Nuestro equipo se pondrá en contacto contigo. Tus credenciales para conectar será enviados por email.');
    }

}
