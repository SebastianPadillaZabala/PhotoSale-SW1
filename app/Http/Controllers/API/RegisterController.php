<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Cliente;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

//use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $atributos = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'tokenFirebase' => 'required|string',
        ]);

        //creando usuario
 /*       $user = User::create([
            'success' => true,
            'name' => $atributos['name'],
            'apellido' => "",
            'celular' => "",
            'email' => $atributos['email'],
            'tipo' => 'Cliente',
            //'profile_photo_path' => $atributos['profile_photo_path'],
            'password' => bcrypt($atributos['password'])
        ]);
*/
        $user = new User();
        $user->name = $atributos['name'];
        $user->apellido = "";
        $user->celular = "";
        $user->tipo = 'Cliente';
        $user->email = $atributos['email'];
        $user->password = bcrypt($atributos['password']);
        $user->tokenFirebase = $atributos['tokenFirebase'];
        $user->save();
        

        $cliente = new Cliente();
        $cliente->photo = "s";
        $cliente->id_user = $user->id;
        $cliente->save();

        $response = [
            //'success' => true,
            'token' => $user->createToken('MyApp')->accessToken,
            'id' => $user->id,
            'name' => $user->name,
            'user' => $user,
        ];

        return response()->json($response, 200);
    }

    public function foto(Request $request)
    {
        $image = $request->file('file');
        $name = time() . $image->getClientOriginalName();
        $filepath = $name;
        Storage::disk('s3')->put($filepath, file_get_contents($image));

        $id = DB::table('users')->max('id');
        $user = User::find($id);
        $user->profile_photo_path = $filepath;
        $user->save();
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var \App\Models\MyUserModel $user **/
            $user = Auth::user();
            if ($user->tipo == 'Cliente') {
                $response = [
                    'success' => true,
                    'token' => $user->createToken('MyApp')->accessToken,
                    'id' => $user->id,
                    'name' => $user->name,
                    'user' => $user,
                ];
                return response()->json($response, 200);
            } else {
                return $this->sendError('No autorizado', ['error' => 'Credenciales invalidas: solo Clientes']);
            }
        } else {
            return $this->sendError('No autorizado ', ['error' => 'Credenciales invalidas']);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->token();
        $token->revoke();
        $response = ["message" => "Has cerrado sesion"];

        return response($response, 200);
    }

    public function user()
    {
        $response = [
            'user' => auth()->user(),
        ];
        return response($response, 200);
    }



    public function userUpdate(Request $request)
    {

        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        if ($user->email == $request->email) {
            $atributos = $request->validate([
                'name' => 'required|string',
                'apellido' => 'string|nullable',
                'celular' => 'string|nullable',
            ]);
            $user->update([
                'name' => $atributos['name'],
                'apellido' => $atributos['apellido'],
                'celular' => $atributos['celular'],
            ]);
        } else {
            $request->validate([
                'name' => 'required|string',
                'apellido' => 'string|nullable',
                'email' => 'required|email|unique:users,email',
                'celular' => 'string|nullable',
            ]);
            $user->update($request->all());
        }

        $response = [
            'message' => 'Usuario actualizado',
            'user' => $user,
        ];
        return response($response, 200);
    }
    /*
    public function getAlumno($id_user){
        $id = $id_user;

        $alumno = DB::select('SELECT alumnos., users., suscripciones.fecha_inicio, suscripciones.fecha_final, (true) as x
        FROM alumnos, users, suscripciones
        where alumnos.id_user=users.id and users.id = '.$id. 'and suscripciones.id_user ='.$id);
        if($alumno == null){
            $alumno = DB::select('SELECT alumnos., users., (false) as x
            FROM alumnos, users where alumnos.id_user=users.id and users.id = '. $id);
        }

        $this_alumno = $alumno[0];
        if($this_alumno->x){
            $response= [
                'id_alum'=> $this_alumno->id_alum,
                'cantidad_cursos'=> $this_alumno->cantidad_cursos,
               // 'suscripcion'=> $this_alumno->suscripcion,
                'id_user'=> $this_alumno->id_user,
                'x'=> $this_alumno->x,
                'fecha_inicio'=> $this_alumno->fecha_inicio,
                'fecha_final'=> $this_alumno->fecha_final,
            ];
            return response($response, 200);
        }else{
            $response= [
                'id_alum'=> $this_alumno->id_alum,
                'cantidad_cursos'=> $this_alumno->cantidad_cursos,
               // 'suscripcion'=> $this_alumno->suscripcion,
                'id_user'=> $this_alumno->id_user,
                'x'=> $this_alumno->x,
                'fecha_inicio'=> '',
                'fecha_final'=> '',
            ];
            return response($response, 200);
        }

    }
*/
}
