<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="modal fade" id="delete-sender-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <span class="h4 text-dark fw-bold">Hapus Pengirim</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div>
                        <span>
                            Apakah anda yakin ingin menghapus pengirim
                        </span>
                        <span id="detail-sender-name" class="fw-bold">
                            ...
                        </span>
                        <span>
                            dengan alamat 
                        </span>
                        <span id="detail-sender-address" class="fw-bold">
                            ...
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-md btn-submit mx-2 close text-white" data-bs-dismiss="modal" aria-label="close">
                            Batal
                        </button>
                        <button class="btn btn-md btn-danger mx-2" data-id="" id="delete-sender-btn">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    @include('public.dashboard.sidebar')
    
    <div class="main">
        @include('public.dashboard.header')
        <div class="bg-dashboard"></div>
        <div class="container-fluid mt-negative w-100">
            @yield('content')
        </div>
    </div>
    @include('public.dashboard.scriptjs')
    @yield('single-page-js')
</body>

</html>