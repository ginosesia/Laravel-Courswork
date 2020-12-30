@extends('layouts.app')
@section('content')
<div class="container">
    <div class="register" style="margin-top: 70px;">
        <div class="center">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="title">
                <h2>Sign Up</h2>
                </div>
                <br>
                    <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row">    
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('role') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="role" name="role" required focus>
                                    <option value="Admin"  selected>Admin</option>        
                                    <option value="Student"  selected>Student</option>        
                                    <option value="Select Role" disabled selected>Select Role</option>        
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" 
                                name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="submit">

                        <div class="form-group row mb-0">
                            <br>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a class="btn btn-link" href="/login">
                                    {{ __('Already have an account?') }}
                                </a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
@endsection

<style>
.register {
    background: #f1f1f1;
    padding: 20px 40px 20px;
    border-radius: 12px;
    margin-right: 55px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}

.title {
        text-align: center;
    }

    .center {
        margin: auto;
        width: 70%;
        text-align: right;
    }

    .submit {
        text-align: center;
    }



</style>