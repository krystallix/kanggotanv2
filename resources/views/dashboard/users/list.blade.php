@extends('layout.dashboard')

@section('content')
<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-4 col-4">
                    <h4 class="card-title mb-0 text-dark px-2 py-2">List Users</h4>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 col-8">
                    <div class="search-usersa">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Users" id="search-data" aria-describedby="button-addon2">
                            <button class="btn btn-submit text-white" type="button" id="search-users-btn">Cari</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                    </div> 
                </div>
            </div>
        </div>
        <div class="card-body py-1">
            <table class="table text-nowrap mb-0">
                <thead class="fw-bold">
                    <td>
                        Nama
                    </td>
                    <td>
                        No Telp
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Role
                    </td>
                    <td>
                        Status
                    </td>
                    <td>
                        
                    </td>
                </thead>
                <tbody id="list-users">

                </tbody>
            </table>
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
<script src="{{asset('js/dashboard/users/list.js')}}"></script>

@endsection