<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/favicon.ico')}}">
    
    <title>Dashboard</title>
    
    <!-- bootstrap.min css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Snackbar -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/node-snackbar@latest/dist/snackbar.min.css" />
    <link rel="stylesheet" href="{{asset('css/essentials.css')}}">
    <style>
        .terminal {
            background: #F9F7F3;
        }
        
        .terminal {
            font-family: 'Ubuntu Mono', monospace;
            color: #5f5f5f;
            font-size: 16px;
            font-weight: 100;
        }
        .terminal-secondary{
            color: #bebebe;
        }
        .timestamps{
            color: #E3A038;
        }
        .sender-name{
            color: #AE68DD;
        }
        .destroy{
            color: #DA4939;
        }
        .create{
            color: #75A20A;
        }
        .add{
            color: #a2c259;
        }
        .edit{
            color: #6D9CBE;
        }
        .user{
            color: #b45dee;
        }
        .dollar{
            color: #c5a371;
        }
        .terminal-input {
            background: rgba(0, 0, 0, 0);
            font-family: monospace;
            width: 100%;
            color: transparent;
            font-size: 14px;
            outline: none;
            border: none;
            -webkit-text-fill-color: rgb(187,187,187);
        }
        .console-carrot {
            vertical-align: middle;
            background: #b45dee;
            height: 15px;
            width: 8px;
            margin-left: -88%;
            display: inline-block;
            animation: blink 1s step-start 0s infinite;
        }
        
        ::selection {
            background-color: #fff;
            color: #000;
        }
        
        @keyframes blink {
            50% {
                opacity: 0.0;
            }
        }
    </style>   
    @yield('single-page-css')
</head>
<body>
    <div id="loading" class="loading-overlay hidden">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div>
                <div class="half-circle-spinner mx-auto">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                </div>
                <div class="py-2">
                    <span class="text-white fw-bold">
                        Please wait y ges y
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        @include('public.dashboard.sidebar')
        <div class="main">
            @include('public.dashboard.header')
            <div class="terminal w-100 ps-2 h-100">
                <div class="terminal-secondary">
                    ===================================================<br>
                    + -------------> LOGGING DATA HAUL <--------------+<br>
                    + -----------------> TAHUN 2022 <-----------------+<br>
                    ===================================================<br>
                    + Log : ------------------------------------------+<br>
                </div>
                <div class="py-1" id='log-data'>
                </div>
                <input autocomplete='off' autocorrect='off' id='go-up' autocapitalize='off' spellcheck='false' type='text' placeholder='press any key to go up.' class='terminal-input' /><div class='console-carrot'></div>
            </div>
        </div>
        @include('public.dashboard.scriptjs')
        <script src="{{asset('js/dashboard/haulmassal/log.js')}}"></script>
    </body>
    
    </html>