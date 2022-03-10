@extends('layout.dashboard')

@section('content')
<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-4 col-4">
                    <h4 class="card-title mb-0 text-dark px-2 py-2">List Data</h4>
                    <div class="stats text-dark px-2 py-2">
                        <span id="total-sender" class="pe-2">
                            
                        </span>
                        <span id="total-arwah" class="ps-2">
                            
                        </span>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 col-8">
                    <div class="search-data">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari pengirim" id="search-data" aria-describedby="button-addon2">
                            <button class="btn btn-submit text-white" type="button" id="search-data-btn">Cari</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="download-xls text-dark">
                            <span>
                                <a  href="#" id='download-data-haul' >  Download Data <i class="fa-solid fa-download"></i></a>
                            </span>      
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
        <div class="card-body py-1">
            <div id="table-responsives" style="overflow: auto">
                <table class="table table-hover text-nowrap table-sm table-haul mb-0">
                    <thead class="fw-bold">
                        <tr>
                            <td>No</td>
                            <td>Nama Pengirim</td>
                            <td>Alamat Pengirim</td>
                            <td>No</td>
                            <td>Nama Arwah</td>
                            <td>Makam Arwah</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="data-haul">
                        
                    </tbody>
                </table>
            </div>
            <div class="d-flex mt-4 justify-content-center">
                <div id="no-data"></div>
                <ul class="px-2 pagination pagination-sm">
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{asset('js/dashboard/haulmassal/show.js')}}"></script>

@endsection