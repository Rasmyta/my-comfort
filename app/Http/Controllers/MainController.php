<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Salon;
use Exception;
use Illuminate\Http\Request;
use Log;

class MainController extends Controller
{

    public function createSalon()
    {
        return view('client.register-salon');
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
            'activity_id' => 'required|numeric'
        ]);
        try {
            $salon = new Salon;
            $salon->name = $request->name;
            $salon->cif = $request->cif;
            $salon->employees = $request->employees;
            $salon->address = $request->address;
            $salon->city = $request->city;
            $salon->postal_code = $request->postal_code;
            $salon->activity_id = $request->activity_id;
            $salon->save();
        } catch (Exception $e) {
            Log::error("Error en BD insertando salon: " . $e->getMessage());
            // return $e->getMessage();
            // return url()->previous();
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
