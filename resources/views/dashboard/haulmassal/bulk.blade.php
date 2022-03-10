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
                <a href='{{route('haul-massal.input')}}'>Normal Input</a>
            </div>
            
        </div>
        <div class="card-body py-1">
            <form id='bulk-store' method="post">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-0 py-2">
                            <label for="name">Nama Pengirim</label>
                            <input type="text" class="form-control form-control-lg py-2" name="name" id="name" autocomplete="off" placeholder="Nama" required>
                        </div>
                        <div class="form-group mb-0 py-2">
                            <label for="phone">Nomor Pengirim ( jika ada )</label>
                            <input type="text" class="form-control form-control-lg py-2" name="phone" id="phone" value='-' autocomplete="off" placeholder="0812-xxxx-xxxx" value="-" required>
                        </div>
                        <div class="form-group mb-0 py-2">
                            <label for="address">Alamat Pengirim</label>
                            <input type="text" class="form-control form-control-lg py-2 typehead" name="address" id="address" autocomplete="off" placeholder="Alamat" required>
                        </div>
                        <div class="d-flex justify-content-between my-2">
                            <textarea class='form-control me-2' id='arwah_name' placeholder="example &#10;Bp. Nama Arwah &#10;Sdr. Nama Arwah 2&#10;&#10;Note:&#10;Use .(dot) between gender and name&#10;Use Enter to separate each name" rows=10 required></textarea>
                            <textarea class='form-control ms-2' id='arwahs_address' placeholder="Use Enter to Separate Address" rows=10 required></textarea>
                        </div>
                        <div class="text-helper mb-4">
                            <span id="text-helper" class="text-danger"></span>
                        </div>
                        <div class="d-flex py-2">
                            <button type="submit" class="btn btn-lg  btn-submit mx-2 text-white rounded form-control">Submit Data</button>    
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $("#bulk-store").submit(function(e){
        e.preventDefault()
        var arwah_type = new Array()
        var arwah_name = new Array()
        
        var sender = $('#name').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var name = $('#arwah_name').val().split(/\r?\n/);
        var addr = $('#arwahs_address').val().split(/\r?\n/);
        $.each(name, function(k, v) {
            var [type, ...rest] = v.split('.')
            var name = rest.join()
            name = $.trim(name)
            if(type == "Bp"){
                type = "Bapak"
            }else if(type == "Sdr"){
                type =  "Saudara"
            }else if(type == "Ibu"){
                type =  "Ibu"
            }else if(type == "Adik"){
                type =  "Adik"
            }
            arwah_type.push(type)
            arwah_name.push(name)
        })
        var arwah_type = $.map(arwah_type, function(v) {
            return v === "" ? null : v;
        });
        var arwah_name = $.map(arwah_name, function(v) {
            return v === "" ? null : v;
        });
        var addr = $.map(addr, function(v) {
            return v === "" ? null : v;
        });

        if(arwah_type.length != arwah_name.length || arwah_name.length != addr.length || arwah_type.length != addr.length){
            $("#text-helper").text("Jumlah data tidak sama")
            return false
        }else{
            data = "name="+JSON.stringify(sender)+"&phone="+JSON.stringify(phone)+"&address="+JSON.stringify(address)+"&arwah_type="+JSON.stringify(arwah_type)+"&arwah_name="+JSON.stringify(arwah_name)+"&arwah_address="+JSON.stringify(addr)
            auth = Cookies.get("auth")
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });    
            $.ajax({
                method: 'POST',
                url: '/ajax/bulk',
                data: 'token='+auth+'&'+data,
                beforeSend: function() {
                    $('#loading').removeClass('hidden')
                },
                success: function (msg) {
                    $('#loading').addClass('hidden')
                    msg = JSON.parse(msg)
                    if(msg.code==200){
                        Snackbar.show({
                            text: 'Submit Data Success',
                            // backgroundColor: '#fff',
                            textColor: '#24D1BC',
                            pos: 'top-right',
                            duration: '2000',
                            showAction: false,
                        });
                        redirect('/dashboard/haul-massal/bulk-store')
                    }
                    else if(msg.code==500){
                        Snackbar.show({
                            text: 'Submit Data Failed',
                            // backgroundColor: '#fff',
                            textColor: '#f35b50',
                            pos: 'top-right',
                            duration: '2000',
                            showAction: false,
                        });
                    }
                },
                error: function (msg, textStatus) {
                    $('#loading').addClass('hidden')
                    msg = JSON.parse(msg)
                    if(msg.code==500){
                        Snackbar.show({
                            text: 'Submit Data Failed',
                            // backgroundColor: '#fff',
                            textColor: '#f35b50',
                            pos: 'top-right',
                            duration: '2000',
                            showAction: false,
                        });
                    }
                }
            });
        }
    })
</script>
@endsection