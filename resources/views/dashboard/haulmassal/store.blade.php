@extends('layout.dashboard')

@section('single-page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css" integrity="sha512-okE4owXD0kfXzgVXBzCDIiSSlpXn3tJbNodngsTnIYPJWjuYhtJ+qMoc0+WUwLHeOwns0wm57Ka903FqQKM1sA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 mx-auto">
    <div class="card">
        <div class="card-header">        
            <div class="d-flex justify-content-between">
                <h5 class="card-title mb-0">Store Data</h5>
                <a href='{{route('haul-massal.bulk-store')}}'>Bulk Store</a>
            </div>
            
        </div>
        <div class="card-body py-1">
            <div class="row">
                <form method="post" id="form-arwah">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-0 py-2">
                            <label for="name">Nama Pengirim</label>
                            <input type="text" class="form-control form-control-lg py-2" name="name" id="name" autocomplete="off" placeholder="Nama" required>
                        </div>
                        <div class="form-group mb-0 py-2">
                            <label for="phone">Nomor Pengirim ( jika ada )</label>
                            <input type="text" class="form-control form-control-lg py-2" name="phone" id="phone" autocomplete="off" placeholder="0812-xxxx-xxxx" value="-" required>
                        </div>
                        <div class="form-group mb-0 py-2">
                            <label for="address">Alamat Pengirim</label>
                            <input type="text" class="form-control form-control-lg py-2 typehead" name="address" id="address" autocomplete="off" placeholder="Alamat" required>
                        </div>
                        <div class="div-arwah" id="div-arwah-0">
                            <div class="pt-2">
                                <label for="">Nama Arwah</label>
                            </div>
                            <div class="d-flex mb-0 pb-2">
                                <div class="form-group ">
                                    <select class="form-select form-select-lg me-5" name="arwah_type[]" required>
                                        <option value="Bapak">Bp.</option>
                                        <option value="Ibu">Ibu.</option>
                                        <option value="Saudara">Sdr.</option>
                                        <option value="Adik">Adik.</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control form-control-lg ms-2" name="arwah_name[]" placeholder="Nama Arwah" autocomplete="off" required>
                                <input type="text" class="form-control form-control-lg py-2 ms-2" name="arwah_address[]" placeholder="Alamat Makam" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-0 py-2">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end py-2" id="add-remove-row">
                            <button class="btn btn-md btn-danger mx-2 text-white rounded" type="button" id="remove-row-btn"><i class="fa-solid fa-minus fw-bold"></i></button> 
                            <input type="number" class="form-control w-15" value='1' id="total-row">   
                            <button class="btn btn-md btn-submit mx-2 text-white rounded" type="button" id="add-row-btn"><i class="fa-solid fa-plus fw-bold"></i></button>    
                        </div>
                        <div class="d-flex py-2">
                            <button type="submit" class="btn btn-lg  btn-submit mx-2 text-white rounded form-control">Submit Data</button>    
                        </div>
                    </div>
                </form>   
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{asset('js/dashboard/haulmassal/store.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>

</script>
@endsection