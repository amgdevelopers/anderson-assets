<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Storage;

class AssetsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Todo: validate request

        $client = Client::firstOrCreate( 
            [ 'directory' => Str::slug($request->client, '-') ],
            [ 'name' => Str::title($request->client) ]
        );

        $asset = Asset::firstOrCreate(
            [ 'uri' => $request->job . '-' . $request->size ],
            [ 'client_dir' => $client->directory ]
        );

        Zipper::make( $request->file('asset') )->extractTo( storage_path('app/public/' . $client->directory . '/' . $asset->uri ) );

        return redirect()->action('HomeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        
        $directory = $asset->client_dir.'/'.$asset->uri;
        
        $asset->delete();
        
        Storage::deleteDirectory($directory);
        
        return redirect()->action('HomeController@index');
    }
}
