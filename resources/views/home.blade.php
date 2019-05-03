@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New HTML5 Banner</div>
                <div class="card-body">
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

    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">HTML5 Banners</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            hello
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
