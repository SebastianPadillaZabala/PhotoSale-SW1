<?php

namespace App\Http\Controllers;

use App\Models\Organizador;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrganizadorController extends Controller
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
        $user->tipo = 'Organizador';
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $organizador = new Organizador();
        $organizador->id_user = $user->id;
        $organizador->save();

        $email = $request->input('email');
        $pass = $request->input('password');
        $credentials = array(
            'email' => $email,
            'password' => $pass
        );
        $auth = Auth::attempt($credentials);

        return redirect()->route('dashOrg');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organizador  $organizador
     * @return \Illuminate\Http\Response
     */
    public function show(Organizador $organizador)
    {
        //
    }

    public function misEventos()
    {
        $id = auth()->user()->id;

        $eventos = DB::table('eventos')
            ->join('organizadors', 'eventos.id_fotog', '=', 'organizadors.id_organizador')
            ->join('users', 'organizadors.id_user', '=', 'users.id')
            ->select('eventos.*', 'users.*',  'organizadors.*')
            ->where('users.id', '=', $id)
            ->get();

        return view('organizador.card-even', ['eventos' => $eventos]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organizador  $organizador
     * @return \Illuminate\Http\Response
     */
    public function edit(Organizador $organizador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organizador  $organizador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organizador $organizador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organizador  $organizador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organizador $organizador)
    {
        //
    }
}
