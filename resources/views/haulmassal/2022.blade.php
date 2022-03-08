@extends('layout.main')

@section('content')
<div class="banner-area banner-2">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-xl-9 col-md-9 m-auto text-center col-sm-12 col-md-12">
                        <div class="banner-content content-padding">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mb-0 px-2 py-2">List Data</h4>
                                        <div class="search-data">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" placeholder="Cari pengirim" id="search-data" aria-describedby="button-addon2">
                                                <button class="btn btn-submit text-white btn-sm mt-0" type="button" id="search-data-btn">Cari</button>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="card-body py-1 pt-3">
                                        <div id="table-responsives">
                                            <table class="table table-hover text-wrap mb-0">
                                                <thead class="fw-bold">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Nama Pengirim</td>
                                                        <td>Alamat Pengirim</td>
                                                        <td>Nama Arwah</td>
                                                        <td>Makam Arwah</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="data-haul">
                                                    
                                                </tbody>
                                            </table>
                                            <div class="d-flex mt-4 justify-content-center">
                                                <div id="no-data"></div>
                                                <div class="px-2 pagination">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{asset('js/login.js')}}"></script>

@endsection