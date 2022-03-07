@extends('layout.dashboard')

@section('content')
<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mx-auto">
    <div class="card">
        <div class="card-header">        
            <h5 class="card-title mb-0">List Data</h5>
        </div>
        <div class="card-body py-1">
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
                    <div class="px-2 pagination">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{asset('js/dashboard/show_haulmassal.js')}}"></script>
@endsection