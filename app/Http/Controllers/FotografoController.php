<?php

namespace App\Http\Controllers;

use App\Models\Fotografo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FotografoController extends Controller
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
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->apellido = $request->input('apellido');
        $user->celular = $request->input('celular');
        $user->tipo = 'Fotografo';
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $fotografo = new Fotografo();
        $fotografo->estado = 'Disponible';
        $fotografo->id_user = $user->id;
        $fotografo->save();

        $email = $request->input('email');
        $pass = $request->input('password');
        $credentials = array(
            'email' => $email,
            'password' => $pass
        );
        $auth = Auth::attempt($credentials);

        return redirect()->route('dashFotog');
    }

    public function all()
    {
        $fecha_actual = Carbon::now();
        /* $fotografos = DB::select('select * from fotografos INNER JOIN users
        ON fotografos.id_user = users.id
        INNER JOIN suscripcions ON suscripcions.id_user = users.id');*/

        $fotografos = DB::table('fotografos')
            ->join('users', 'users.id', '=', 'fotografos.id_user')
            ->join('suscripcions', 'suscripcions.id_user', '=', 'users.id')
            ->select('fotografos.*', 'users.*')
            ->where('suscripcions.fecha_final', '>=', $fecha_actual)->get();

        return view('layouts.card-fotog', ['fotografos' => $fotografos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fotografo  $fotografo
     * @return \Illuminate\Http\Response
     */
    public function show(Fotografo $fotografo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fotografo  $fotografo
     * @return \Illuminate\Http\Response
     */
    public function edit(Fotografo $fotografo)
    {
        //
    }

    public function misEventos()
    {
        $id = auth()->user()->id;

        $eventos = DB::table('eventos')
            ->join('fotografos', 'eventos.id_fotog', '=', 'fotografos.id_fotografo')
            ->join('users', 'fotografos.id_user', '=', 'users.id')
            ->select('eventos.*', 'users.*',  'fotografos.*')
            ->where('users.id', '=', $id)
            ->get();

        return view('fotografo.card-even', ['eventos' => $eventos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fotografo  $fotografo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fotografo $fotografo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fotografo  $fotografo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fotografo $fotografo)
    {
        //
    }
}
