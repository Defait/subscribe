<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('css/bulma.css')}}">
    <title>{{ env('APP_NAME')}}</title>
</head>
<div class="container">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a href="{{ route('home')}}" class="navbar-item">
                <img src="https://i.imgur.com/YZ4w2ey.png" alt="{{ env('APP_NAME') }}">
            </a>
            <button class="button navbar-burger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="navbar-menu">
            <div class="navbar-start">
                <a href="" class="navbar-item">
                    Home
                </a>
            </div>
            <div class="navbar-end">
                <a href="{{ url('login')}}" class="navbar-item">
                    Signup/Signin
                </a>
            </div>
        </div>
    </nav>
</div>