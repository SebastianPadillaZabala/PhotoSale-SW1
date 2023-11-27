<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventoController extends Controller
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
        $fecha_actual = Carbon::now();
        $fotografos = DB::table('fotografos')
        ->join('users', 'users.id', '=', 'fotografos.id_user')
        ->join('suscripcions', 'suscripcions.id_user', '=', 'users.id')
        ->select('fotografos.*', 'users.*' )
        ->where('suscripcions.fecha_final', '>=', $fecha_actual)->get();

        return view('register.registrar_even', ['fotografos'=>$fotografos]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = new Evento();
        $evento->nombre_evento = $request->input('name');
        $evento->fecha = $request->input('fecha');
        $evento->hora = $request->input('hora');
        $evento->lugar = $request->input('lugar');
        $evento->tipo_evento = $request->input('tipo_evento');
        $id =  DB::table('organizadors')->where('id_user', '=', auth()->user()->id)->value('id_organizador');
        $evento->id_org = $id;
        $evento->id_fotog = $_POST['select'];
        $evento->save();
        return redirect()->route('eventosOrganizador');
    }


    public function all(){
       /* $eventos = DB::select('select * from eventos INNER JOIN organizadors
        ON eventos.id_org = organizadors.id_organizador
        INNER JOIN users ON users.id = organizadors.id_user');*/

        $id = auth()->user()->id;

        $eventos = DB::table('eventos')
        ->join('organizadors', 'eventos.id_org', '=', 'organizadors.id_organizador')
        ->join('users', 'organizadors.id_user', '=', 'users.id')
        ->select('eventos.*', 'users.*',  'organizadors.*')
        ->where('users.id', '=', $id)
        ->get();

        return view('layouts.card-even', ['eventos'=>$eventos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
