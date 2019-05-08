@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom border-gray pb-2 mb-0">Add New HTML5 Banner</h6>
                <div class="py-3">
                    <form method="POST" action="{{ route('assets.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>

                            <div class="col-md-6">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required autocomplete="client" placeholder="Anderson Marketing Group" autofocus>

                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job" class="col-md-4 col-form-label text-md-right">{{ __('Job #') }}</label>

                            <div class="col-md-6">
                                <input id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job') }}" required autocomplete="job" placeholder="555555">

                                @error('job')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Ad Size') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('size') is-invalid @enderror" id="size" name="size" value="{{ old('size') }}" required>
                                    <option>300x250</option>
                                    <option>728x90</option>
                                    <option>160x600</option>
                                    <option>300x600</option>
                                </select>

                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {{ __('Zip File') }}    
                            </div>
                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input onchange="updateLabel()" type="file" class="custom-file-input" id="asset" name="asset">
                                    <label class="custom-file-label text-truncate" for="asset">Choose File</label>
                                    @error('asset')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary text-uppercase">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @forelse ($clients as $client)
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">{{ $client->name }}</h6>
            @forelse ($client->assets as $asset)
                <div class="media text-muted pt-3">
                    <i class="mr-3 fab fa-html5 fa-2x"></i>
                    <div class="media-body pb-2 mb-0 small border-bottom border-gray">
                        <form class="w-100 d-inline" action="{{ route('assets.destroy', ['id' => $asset->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <strong><a href="{{ secure_url("storage/{$asset->client_dir}/{$asset->uri}/index.html") }}" target="_blank" id="link-{{$asset->id}}" class="text-muted">{{ $asset->uri }}</a></strong>  
                            <button type="submit" class="btn float-right py-0 px-2 border-0 text-primary" title="Delete HTML5 Ad"><i class="far fa-trash-alt" style="font-size:1.2rem;"></i></button>
                        </form>
                        <button class="btn float-right py-0 px-2 border-0 text-primary" onclick="copyLink({{$asset->id}})" title="Copy Link To Clipboard"><i class="far fa-clipboard" style="font-size:1.2rem;"></i></button>
                    </div>
                </div>
            @empty
                <div class="media text-muted pt-3">
                    <i class="mr-3 fas fa-exclamation-triangle fa-2x"></i>
                    <div class="media-body mb-0">
                        There are currently no HTML5 ads for this client.
                    </div>
                </div>    
            @endforelse
        </div>
    @empty
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6>There are currently no clients in your system.</h6>
        </div>
    @endforelse
</div>
<script type="application/javascript">
    function copyLink(assetID) {
        updateClipboard(document.getElementById('link-' + assetID).href);
    }

    function updateClipboard(newClip) {
        navigator.clipboard.writeText(newClip).then(function() {
            console.log('Copied Link: ' + newClip);
        }, function() {
            console.log('Problem with copying to clipboard.');
        });
    }
    
    bsCustomFileInput.init()
    
</script>
@endsection
