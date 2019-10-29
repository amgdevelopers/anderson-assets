<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
	protected $fillable = ['client_dir', 'uri'];

    public function client()
    {
    	return $this->belongsTo('App\Client', 'directory', 'client_dir');
    }

    /**
     * Prepare the uploaded zip and extract the necessary files to the appropriate directory.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function upload( $file )
    {

    	$zip = new \ZipArchive;
    	if ( $zip->open( $file ) === true ) 
    	{
    	    for( $i = 0; $i < $zip->numFiles; $i++ ) 
    	    {
    	        $filename = $zip->getNameIndex($i);
    	        $fileinfo = pathinfo($filename);

    	        if( stripos($fileinfo['dirname'], '__MACOSX') !== false || !isset($fileinfo['extension']) ) {
    	            $zip->deleteIndex($i);
    	            continue;
    	        }
    	        
    	        $paths[] = $filename;
    	    }

    	    if( in_array('index.html', $paths) ) {
    	        $zip->extractTo( storage_path('app/public/' . $this->client_dir . '/' . $this->uri ), $paths);
    	    } else {
    	        $index_html = Arr::first($paths, function ($value, $key) {
    	            return Str::endsWith($value, '/index.html');
    	        });
    	        $slice = Str::before($index_html, 'index.html');

    	        foreach ( $paths as $path ) 
    	        {
    	            $new_name = str_replace($slice, '', $path);
    	            $zip->renameName($path, $new_name);
    	            $zip->extractTo( storage_path('app/public/' . $this->client_dir . '/' . $this->uri ), $new_name);
    	        }
    	    }
    	    $zip->close();
    	}
    }
}
