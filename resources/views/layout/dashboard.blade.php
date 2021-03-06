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
        .bg-dashboard{
            background-color: #3330a3 !important;
            padding-top: 4rem !important;
            padding-bottom: 11rem !important;
        }
        .mt-negative{
            margin-top: -10rem !important;
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
    <div class="modal fade" id="delete-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Apakah anda yakin ingin menghapus User
                        </span>
                        <span id="detail-user-name" class="fw-bold text-dark">
                            ...
                        </span> ?
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-md btn-submit mx-2 close text-white" data-bs-dismiss="modal" aria-label="close">
                            Batal
                        </button>
                        <button class="btn btn-md btn-danger mx-2" data-id="" id="delete-user-btn">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-sender-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <span class="h4 text-dark fw-bold">Hapus Arwah</span>
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
    <div class="modal fade" id="delete-arwah-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <span id="detail-arwah-name" class="fw-bold">
                            ...
                        </span>
                        <span>
                            dengan alamat 
                        </span>
                        <span id="detail-arwah-address" class="fw-bold">
                            ...
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-md btn-submit mx-2 close text-white" data-bs-dismiss="modal" aria-label="close">
                            Batal
                        </button>
                        <button class="btn btn-md btn-danger mx-2" data-id="" id="delete-arwah-btn">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-arwah-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <form id="form-add-arwah" data-id="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <span class="h4 text-dark fw-bold">Tambah Arwah</span>
                        </div>
                    </div> 
                    
                    <div class="modal-body">
                        <div>
                            <span id="detail-add-arwah">
                                Nama Pengirim : ...  Alamat : ....
                            </span>
                        </div>
                        
                        <div class='div-arwah-modal' id='div-arwah-modal-'>
                            <div class="pt-2">
                                <label for="arwahs_name">Nama Arwah</label>
                            </div>
                            <div class="d-flex mb-0 pb-2">
                                <div class="form-group ">
                                    <select class="form-select form-select-lg me-5" name="arwah_type[]" required>
                                        <option value="Bapak">Bp.</option>
                                        <option value="Ibu">Ibu.</option>
                                        <option value="Saudara">Sdr.</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control form-control-lg ms-2" name="arwah_name[]" placeholder="Nama Arwah" required>
                            </div>
                            <div class="form-group mb-0 py-2">
                                <label for="arwah_address">Alamat Makam</label>
                                <input type="text" class="form-control form-control-lg py-2" name="arwah_address[]" placeholder="Alamat Makam" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end py-2" id="add-remove-row-modal">
                            <button class="btn btn-md btn-danger mx-2 text-white rounded" type="button" id="remove-row-btn-modal"><i class="fa-solid fa-minus fw-bold"></i></button> 
                            <input type="number" class="form-control w-15" value='1' id="total-row-modal">   
                            <button class="btn btn-md btn-submit mx-2 text-white rounded" type="button" id="add-row-btn-modal"><i class="fa-solid fa-plus fw-bold"></i></button>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-md btn-submit mx-2 close text-white" type="button" data-bs-dismiss="modal" aria-label="close">
                                Batal
                            </button>
                            <button class="btn btn-md btn-submit text-white mx-2" data-id="" type="submit" id="add-arwah-btn">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="edit-arwah-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <form id="form-edit-arwah" data-id="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <span class="h4 text-dark fw-bold">Edit Arwah</span>
                        </div>
                    </div>  
                    <div class="modal-body">
                        <div>
                            
                            <span>Edit arwah dari pengirim <span id="edit-detail" class="fw-bold">...</span></span>
                        </div>
                        <div class="pt-2">
                            <label for="arwahs_name">Nama Arwah</label>
                        </div>
                        <div class="d-flex mb-0 pb-2">
                            <div class="form-group ">
                                <select class="form-select form-select-lg select-arwahtype me-5" name="arwah_type"  id='arwah_type' required>
                                    <option value="Bapak">Bp.</option>
                                    <option value="Ibu">Ibu.</option>
                                    <option value="Saudara">Sdr.</option>
                                    <option value="Adik">Adik.</option>
                                </select>
                            </div>
                            <input type="text" class="form-control form-control-lg ms-2" name="arwah_name" id='arwahs_name' placeholder="Nama Arwah" required>
                        </div>
                        <div class="form-group mb-0 py-2">
                            <label for="arwah_address">Alamat Makam</label>
                            <input type="text" class="form-control form-control-lg py-2" name="arwah_address"  id='arwah_address' placeholder="Alamat Makam" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-md btn-submit mx-2 close text-white" type="button" data-bs-dismiss="modal" aria-label="close">
                                Batal
                            </button>
                            <button class="btn btn-md btn-submit text-white mx-2" data-id="" type="submit" id="edit-arwah-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="edit-sender-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <form id="edit-sender-form" method="post">
                    <div class="modal-header">
                        <div>
                            <span class="h4 text-dark fw-bold">Edit Pengirim</span>
                        </div>
                    </div>  
                    <div class="modal-body">
                        <div class="form-group py-2">
                            <label for="input-sender">Nama Pengirim</label>
                            <input type="text" name='name' class="form-control" id="input-sender">
                        </div>
                        <div class="form-group py-2">
                            <label for="input-phone">No Telp</label>
                            <input type="text" name='phone' class="form-control" id="input-phone">
                        </div>
                        <div class="form-group py-2">
                            <label for="input-address">Alamat Pengirim</label>
                            <input type="text" name='address' class="form-control" id="input-address">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-md btn-submit mx-2 close text-white" type="button" data-bs-dismiss="modal" aria-label="close">
                                Batal
                            </button>
                            <button class="btn btn-md btn-submit text-white mx-2" data-id="" type="submit" id="edit-sender-btn">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
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