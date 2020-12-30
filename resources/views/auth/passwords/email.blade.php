@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="center" style="margin: 65px 75px 0 15px;">
            <div class="card">
                <div class="card-header" style="text-align: center"><h2>{{ __('Reset Password') }}</h2>
                <br></div>

                <div class="resetbox">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="submit">
<br>
                            <div class="form-group row mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

    .center {
    background: #f1f1f1;
    padding: 20px 40px 20px;
    border-radius: 12px;
    margin-right: 55px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    
    }

    .resetbox {
        margin: auto;
        width: 70%;
        text-align: right;

    }
    
    .submit {
        text-align: center;
    }

    </style>
    