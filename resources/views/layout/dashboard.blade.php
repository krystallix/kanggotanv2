<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <title>Dashboard</title>
    
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/essentials.css')}}">
    <style>
        .bg-dashboard{
            background-color: #3330a3 !important;
            padding-top: 4rem !important;
            padding-bottom: 11rem !important;
        }
        .mt-negative{
            margin-top: -10rem !important;
        }
    </style>   
</head>

<body>
    <div class="wrapper">
        @include('public.dashboard.sidebar')
        
        <div class="main">
            @include('public.dashboard.header')
            <div class="bg-dashboard"></div>
            <div class="container-fluid mt-negative px-6">
                @yield('content')
            </div>
        </div>
        @include('public.dashboard.scriptjs')
    </body>
    
    </html>