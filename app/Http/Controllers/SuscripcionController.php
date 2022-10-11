<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
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
    public function store(Request $request, $id)
    {
        
        $suscripcion = new Suscripcion();
        $suscripcion->nombre_plan = DB::table('plans')->where('id_Plan',$id)->value('nombre_Plan');
        $suscripcion->fecha_inicio = Carbon::now();
        $p = Carbon::now();
        $aux = DB::table('plans')->where('id_Plan',$id)->value('duracion');
        $suscripcion->fecha_final = $p->addDay($aux);
        $suscripcion->id_user = auth()->user()->id;
        $suscripcion->id_plan = $id;
        $suscripcion->save();

        $pago = new Pago();
        $pago->monto = DB::table('plans')->where('id_Plan',$id)->value('Precio');
        $pago->owner = $request->input('nombre');
        $pago->card_number = $request->input('card_number');
        $pago->expiration_month = $_POST['month'];
        $pago->expiration_year = $_POST['year'];
        $pago->security_code = $request->input('code');
        $pago->id_user = auth()->user()->id;
        $pago->id_suscripcion = DB::table('suscripcions')->max('id_suscrip');
        $pago->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Suscripcion $suscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Suscripcion $suscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suscripcion $suscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suscripcion $suscripcion)
    {
        //
    }
}
