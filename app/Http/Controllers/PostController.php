<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));
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

    public function store(Request $request)
    {  

        if($request->hasFile('file')){


            $client = new RekognitionClient([
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest'
            ]);

            $image = fopen($request->file('file')->getPathname(),'r');
            $bytes = fread($image, $request->file('file')->getSize());

            $result = $client->detectFaces([
                'Image' => ['Bytes' => $bytes],
                "Attributes" => ["ALL"]
                //'Gender' => 50
            ]);


            $resultLabels = $result->get('FaceDetails');

            if($resultLabels[0]['Gender']['Value'] == 'Female'){
                //dd('aceptado');
                //return response('aceptado');
                $response = [
                    'data' => 'aceptado',
                ];
                return response()->json($response, 200);
            }else{
               //dd('rechazado');
               $response = [
                'data' => 'rechazado',
               ];
               // return response('rechazado');
                return response()->json($response, 201);
            }
        }
        //return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|sometimes|file',
            'description' => 'nullable|sometimes'
        ]);
        /*
         $newPost = auth()->user()->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
*/
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = auth()->user()->id;
       

        if($request->hasFile('image')){


            $client = new RekognitionClient([
                'region' => env('AWS_DEFAULT_REGION'),
                'version' => 'latest'
            ]);

            $image = fopen($request->file('image')->getPathname(),'r');
            $bytes = fread($image, $request->file('image')->getSize());

            $result = $client->compareFaces([
                'SourceImage' => [
                    'Bytes' => $bytes,
                    'Similarity' =>99
                ],
                'TargetImage' => [
                    'S3Object' => [
                        'Bucket' => 'sw77-bucket-s3',
                        'Name' => '1665464991image_picker7213288403214370069.jpg',
                    ],
                ],
            ]);

            dd($result);
            
            $image = $request->file('image');

            $name = time().$image->getClientOriginalName();

            $filepath = $name;

            Storage::disk('s3')->put($filepath, file_get_contents($image));
            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
