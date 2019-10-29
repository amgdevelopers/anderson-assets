<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
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
            [ 'uri' => $request->job . '-' . $request->size, 'client_dir' => $client->directory ]
        );

        $zip = new \ZipArchive;
        $path = $request->file('asset');
        if ( $zip->open($path) === true ) 
        {
            for( $i = 0; $i < $zip->numFiles; $i++ ) 
            {
                $filename = $zip->getNameIndex($i);
                $fileinfo = pathinfo($filename);

                if( stripos($fileinfo['dirname'], '__MACOSX') !== false || !isset($fileinfo['extension']) ) {
                    $zip->deleteIndex($i);
                    continue;
                }
                
                $files[] = $filename;
            }

            if( in_array('index.html', $files) ) {
                $zip->extractTo( storage_path('app/public/' . $client->directory . '/' . $asset->uri ), $files);
            } else {
                $index_html = Arr::first($files, function ($value, $key) {
                    return Str::endsWith($value, '/index.html');
                });
                $slice = Str::before($index_html, 'index.html');

                foreach ( $files as $file ) 
                {
                    $new_name = str_replace($slice, '', $file);
                    $zip->renameName($file, $new_name);
                    $zip->extractTo( storage_path('app/public/' . $client->directory . '/' . $asset->uri ), $new_name);
                }
            }
            $zip->close();                  
        }

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
