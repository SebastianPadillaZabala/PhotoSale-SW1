<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotografoController;
use App\Http\Controllers\OrganizadorController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SuscripcionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome-ecommerce');
});

Route::get('/home',[LoginController::class, 'home'])
->name('home');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.sidebar');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('posts', \App\Http\Controllers\PostController::class);
});

////LOGIN

Route::post('/loginn',[LoginController::class, 'login'])
->name('loginn');


///ORGANIZADOR

Route::get('/dashOrg',[FotografoController::class, 'all'])
->name('dashOrg');

Route::get('/regOrg', function () {
    return view('auth.register');
})->name('registrarOrg');

Route::post('/registerOrg',[OrganizadorController::class, 'store'])
->name('registrarOrga');

Route::get('/registerEven',[EventoController::class, 'create'])
->middleware('auth')
->name('registrarEven');

Route::post('/registerEvento',[EventoController::class, 'store'])
->name('registrarEvento');

Route::get('/MiseventosOrg', [OrganizadorController::class, 'misEventos'])
->middleware('auth')
->name('eventosOrganizador');


///FOTOGRAFO

Route::get('/dashFotog',[EventoController::class, 'all'])
->middleware('auth')
->name('dashFotog');

Route::get('/regFot', function () {
    return view('auth.registerFot');
})->name('registrarFot');

Route::post('/registerFot',[FotografoController::class, 'store'])
->name('registrarFoto');

Route::get('/viewFoto/{id}',[FotoController::class, 'index'])
->middleware('auth')
->name('allFoto');

Route::get('/uploadFotoo/{id}',[FotoController::class, 'create'])
->middleware('auth')
->name('createFoto');

Route::post('/uploadFoto/{id}',[FotoController::class, 'store'])
->name('saveFoto');

Route::get('/Miseventos', [FotografoController::class, 'misEventos'])
->middleware('auth')
->name('eventosFotografo');

Route::get('/Secret/{path}', [FotoController::class, 'view'])
->name('clientes-view');

Route::get('/checkout/{path}', [FotoController::class, 'pagoFotoView'])
->name('checkout-fotoView');

Route::post('/checkoutt/{path}',[FotoController::class, 'pagoFoto'])
->name('checkout-foto');

///PLANES

Route::get('/planes',[PlanController::class, 'index'])
->name('planes');

Route::get('/check-out/{id}', [PlanController::class, 'pagos'])
->middleware('auth')
->name('check-out',);

Route::post('/checkout/{id}',[SuscripcionController::class, 'store'])
->name('checkout-input');

//NOTIFICACION-PRUEBA

Route::get('/noti', function () {

    $SERVER_API_KEY = 'AAAAauDoHxc:APA91bE0sD4v8Aw1sZJ0P-ddoYFGNM6TVGCBHo9Wq-CQ3jOcoFaZrhm0ZmRWNZRkCHV7doWq7YifeKZCtLLTToq6wICvI_KR1TNqvjAN1OuIHSuBZrbcSj9UZdqlowGfhu8SSYx139QG';
    $token = 'fN1yU_RuSgetj0dymNQaYi:APA91bEpIsqmXn4iUOR0XB_Ni4V4z2N29bfm4tMdQuSgUAVunNyOUvU7-4TaVwy92MBVgun0D3B_6pTlbgHq8zVd9xp_mXAMyySzYy3u2K4FvlPdcyzd1tLZ2btu4xxDAPNRee9HO4EV';
    $data = [
        "registration_ids" => [
            $token
        ],
        "notification" => [
            "title" => 'Welcome',
            "body" => 'Description',
            "sound" => "default"
        ],

    ];
    
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' .$SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, option: CURLOPT_URL, value: 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, option: CURLOPT_POST, value: true);
    curl_setopt($ch, option: CURLOPT_HTTPHEADER, value: $headers);
    curl_setopt($ch, option: CURLOPT_SSL_VERIFYPEER, value: false);
    curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
    curl_setopt($ch, option: CURLOPT_POSTFIELDS, value: $dataString);

    $response = curl_exec($ch);

    dd($response);



});


