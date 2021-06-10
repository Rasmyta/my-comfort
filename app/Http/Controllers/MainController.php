<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Role;
use App\Models\Salon;
use App\Models\User;
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
            'cif' => 'required',
            'employees' => 'required|numeric|min:1',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required|numeric',
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
        } catch (Exception $e) {
            Log::error("Error en BD: " . $e->getMessage());
        }

        Log::info("Salon insertado");

        return redirect()->back()
            ->with('message', 'Gracias por elegir nosotros! Nuestro equipo se pondrá en contacto contigo. Tus credenciales para conectar será enviados por email.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
