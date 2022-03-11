@extends('layout.dashboard')

@section('single-page-css')
<style>
    .toggle-password {
        float: right;
        cursor: pointer;
        margin-right: 10px;
        margin-top: -25px;
    }
</style>
@endsection
@section('content')
<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title mb-0">Buat User</h5>
            </div>
            
        </div>
        <div class="card-body py-1">
            <form id='create-user-form' method="post">
                <div class="row">
                    <div class="form-group mb-0 py-1">
                        <label for="username">User </label>
                        <input type="text" class="form-control form-control-lg" placeholder='username' name="name" id="username">
                    </div>
                    <div class="form-group mb-0 py-1">
                        <label for="email">E-mail </label>
                        <input type="text" class="form-control form-control-lg" placeholder='email'  name="email" id="email">
                    </div>
                    <div class="form-group mb-0 py-1">
                        <label for="phone">Phone </label>
                        <input type="text" class="form-control form-control-lg" placeholder='phone'  name="phone" id="phone">
                    </div>
                    <div class="form-group mb-0 py-1">
                        <label for="password">Password </label>
                        <input type="password" class="form-control form-control-lg" placeholder='password'  name="password" id="password">
                        <i class="toggle-password fa-solid fa-eye-slash"></i>
                    </div>
                    <div class="select-group mb-0 py-1">
                        <label for="role">Role</label>
                        <select class="form-select form-select-lg"  name="role" id="role">
                            <option id='option_role' value="">Pilih Role</option>
                        </select>
                    </div>
                    <div class="my-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-submit text-white">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{ asset('js/dashboard/users/store.js') }}"></script>
@endsection
