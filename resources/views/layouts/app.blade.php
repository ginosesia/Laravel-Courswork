
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'Web Application')}}</title>        
    </head>
    <body>
        @include('inc.navbar')
        <br>
        <div class="container">
            <div class="container-fluid">
                @include('inc.messages')
                @yield('content')
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
    </body>
</html>
<style>


    .btn.btn-secondary:hover{
        background-color: rgba(1, 1, 1, 0.3);
    }
    
    .btn.btn-secondary{
        border-color: #999;
        background-color: rgba(1, 1, 1, 0.135);
        color: black;
    }

    small {
        
        color: gray;
        padding: 0;
        font-size: 12px;
    }

    div.float-right {
        float: right;
    }
    hr {
        padding: 0;
    }

    .well {
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 20px;
        padding-right: 20px;
        list-style-type: none;
        border-radius: 5px;
    }

    .well:hover {
        border-color: #999;
    }

    a:hover {
        text-decoration: initial;
    }



    </style>