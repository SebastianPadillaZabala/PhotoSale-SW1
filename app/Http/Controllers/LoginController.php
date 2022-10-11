<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use function Ramsey\Uuid\v1;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {

        $email = $request->input('email');
        $pass = $request->input('password');
        $credentials = array(
            'email' => $email,
            'password' => $pass
        );
        $auth = Auth::attempt($credentials);
        if ($auth) {
            $user = Auth::user();
            $tipo = $user->tipo;
            if ($tipo == 'Fotografo') {
                return redirect()->route('dashFotog');
            } else {
                if ($tipo == 'Organizador') {
                    return redirect()->route('dashOrg');
                }
            }
        } else {
            return back()->withErrors([
                'message' => 'El usuario o la contraseña son incorrectos'
            ]);
        }
    }

    public function index()
    {
        //
    }

    public function home(){
        return view('welcome-ecommerce');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
