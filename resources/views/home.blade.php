@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom border-gray pb-2 mb-0">Add New HTML5 Banner</h6>
                <div class="py-3">
                    <form method="POST" action="{{ route('assets') }}" enctype="multipart/form-data">
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
                            <label for="asset" class="col-md-4 col-form-label text-md-right">{{ __('Zip File') }}</label>
                            <div class="col-md-6">
                                
                                <input type="file" class="form-control-file" id="asset" name="asset" >
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
    @foreach ($clients as $client)
    {{-- <div class="row justify-content-center pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $client->name }}</div>
                <div class="card-body">
                    <div class="card-deck">
                        @foreach ($client->assets as $asset)
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><a href="{{ secure_url("storage/{$asset->client_dir}/{$asset->uri}/index.html") }}" id="link-{{$asset->id}}">{{ $asset->uri }}</a></p>
                            </div>
                            <div class="card-footer">
                                <a onclick="copyLink({{$asset->id}})" href="#0" title="Copy Link To Clipboard"><i class="far fa-clipboard fa-2x"></i></a>
                                <a href="#" title="Delete HTML5 Ad"><i class="far fa-trash-alt fa-2x px-3"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">{{ $client->name }}</h6>
        @foreach ($client->assets as $asset)
            <div class="media text-muted pt-3">
                <i class="mr-3 fab fa-html5 fa-2x"></i>
                <div class="media-body pb-2 mb-0 small lh-125 border-bottom border-gray">
                    <div class="w-100">
                        <strong><a href="{{ secure_url("storage/{$asset->client_dir}/{$asset->uri}/index.html") }}" id="link-{{$asset->id}}" class="text-muted">{{ $asset->uri }}</a></strong>
                        <a class="float-right" href="#" title="Delete HTML5 Ad"><i class="far fa-trash-alt fa-2x px-3"></i></a>
                        <a class="float-right" onclick="copyLink({{$asset->id}})" href="#0" title="Copy Link To Clipboard"><i class="far fa-clipboard fa-2x"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
        <small class="d-block text-right mt-3">
          <a href="#">All suggestions</a>
        </small>
    </div>
    @endforeach
</div>
<script>
    function copyLink(assetID) {
        updateClipboard(document.getElementById('link-' + assetID).href);
    }

    function updateClipboard(newClip) {
        navigator.clipboard.writeText(newClip).then(function() {
            /* clipboard successfully set */
            console.log('Copied Link: ' + newClip);
        }, function() {
            /* clipboard write failed */
            console.log('Problem with copying to clipboard.');
        });
    }
</script>
@endsection
