@extends('layouts.app')

@section('content')
<br>
<div class="center" style="margin: 50px 15px 0 15px;">
<div class="jumbotron text-center">
    <h2>{{$title}}</h2>
    <br>
    <p>
        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
        <a class="btn btn-secondary btn-lg" href="/register" role="button">Register</a>
    </p>
</div>
</div>
@endsection


<style>

.center {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 12px;
}

</style>
