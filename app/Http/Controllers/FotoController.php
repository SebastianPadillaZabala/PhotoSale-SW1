<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\foto_pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fotos = DB::table('fotos')->where('id_even', '=', $id)->get();
        return view('fotografo.fotosale', ['fotos' => $fotos], ['id' => $id]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('register.registerFoto', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $users = DB::table('users')->where('tipo', '=', 'Cliente')->get();

        if ($request->hasFile('image')) {


            $client = new RekognitionClient([
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest'
            ]);

            $image = fopen($request->file('image')->getPathname(), 'r');
            $bytes = fread($image, $request->file('image')->getSize());

            foreach ($users as $u) {
                $result = $client->compareFaces([
                    'SourceImage' => [
                        'Bytes' => $bytes,
                    ],
                    'TargetImage' => [
                        'S3Object' => [
                            'Bucket' => 'sw77-bucket-s3',
                            'Name' => $u->profile_photo_path,
                        ],
                    ],
                ]);
                $imageFlu = $request->file('image');
                $y = time() . $imageFlu->getClientOriginalName();
                $y = 'ec2-18-233-99-32.compute-1.amazonaws.com/Secret/'.$y;
                $x = $y;

                $d = $result->get('FaceMatches');
                if ($d != null) {
                    $d = $d[0];
                    $d = $d['Similarity'];
                    if ($d >= 98) {
                        printf('Enviar notificacion= ' . $u->name);
                        $SERVER_API_KEY = 'AAAAauDoHxc:APA91bE0sD4v8Aw1sZJ0P-ddoYFGNM6TVGCBHo9Wq-CQ3jOcoFaZrhm0ZmRWNZRkCHV7doWq7YifeKZCtLLTToq6wICvI_KR1TNqvjAN1OuIHSuBZrbcSj9UZdqlowGfhu8SSYx139QG';
                        //$token = 'fACZ1wjCSrmZocvtjyPIfZ:APA91bGXmIcHPd6dFt-AtQa0XzPIXStT14yY_8CGVTLZHTHAbNrrlJGfrUp5wqK-p7hmkT9E9N9I9eEOJxI3UmPWaOTcPwLBu9O-BPIusQfSg7FdyRl1zau4B5IISomzQR1tHy6SY1A-';
                        $token = $u->tokenFirebase;
                        $data = [
                            "registration_ids" => [
                                $token
                            ],
                            "notification" => [
                                "title" => 'PhotoSale',
                                "body" => $x,
                                "sound" => "default"
                            ],

                        ];

                        $dataString = json_encode($data);
                        //
                        $headers = [
                            'Authorization: key=' . $SERVER_API_KEY,
                            'Content-Type: application/json',
                        ];

                        $ch = \curl_init();

                        curl_setopt($ch, option: CURLOPT_URL, value: 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, option: CURLOPT_POST, value: true);
                        curl_setopt($ch, option: CURLOPT_HTTPHEADER, value: $headers);
                        curl_setopt($ch, option: CURLOPT_SSL_VERIFYPEER, value: false);
                        curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
                        curl_setopt($ch, option: CURLOPT_POSTFIELDS, value: $dataString);

                        $response = curl_exec($ch);
                    }
                }
            }
            $image = $request->file('image');

            $name = time() . $image->getClientOriginalName();

            $filepath = $name;

            Storage::disk('s3')->put($filepath, file_get_contents($image));

            $foto = new Foto();
            $foto->id_fotog = DB::table('fotografos')->where('id_user', '=', auth()->user()->id)->value('id_fotografo');
            $foto->id_even = $id;
            $foto->path = $filepath;
            $foto->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        //
    }

    public function view($path)
    {

        return view('layouts.fotosale', ['path' => $path]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        //
    }

    public function pagoFotoView($path)
    {

        return view('layouts.checkoutSale', ['path' => $path]);
    }


    public function pagoFoto(Request $request, $path)
    {
        $pago = new foto_pago();
        $pago->monto = 10;
        $pago->owner = $request->input('nombre');
        $pago->card_number = $request->input('card_number');
        $pago->expiration_month = $_POST['month'];
        $pago->expiration_year = $_POST['year'];
        $pago->security_code = $request->input('code');
        $pago->save();

        return redirect('https://sw77-bucket-s3.s3.amazonaws.com/'.$path);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        //
    }
}
