
function autocomplete(){
    address_arr = new Array()
    name_arr = new Array()
    $.ajax({
        url: api_server + "/api/nyadran/address",
        method: "get",
        timeout: 0,
        success: function(response){
            $.each(response.data, function(k, v){
                address_arr.push(v.arwah_address)
            })
        }
    })
    $.ajax({
        url: api_server + "/api/nyadran/name/arwahs",
        method: "get",
        timeout: 0,
        success: function(response){
            $.each(response.data, function(k, v){
                name_arr.push(v.arwah_name)
            })
        }
    })
    $( "input[name='arwah_address[]']" ).autocomplete({
        source: address_arr
    });
    $("input[name='arwah_name[]']").autocomplete({
        source: name_arr
    });

    $("input[name='address']").autocomplete({
        source: address_arr
    });
}

i = 1
$(document).on("click", "#add-row-btn", function(){
    i++
    div_arwah = $(".div-arwah").html()
    div_arwah_html = "<div class='div-arwah' id='div-arwah-"+i+"'>"+div_arwah+"</div>"
    total_row = $("#total-row").val()
    for(k=0; k<total_row; k++){
        $("#add-remove-row").before(div_arwah_html)    
    }
    autocomplete()
})

$(document).on("click", "#remove-row-btn", function(){
    div_arwah_length = $('div.div-arwah').length 
    if(div_arwah_length > 1){
        $("div.div-arwah:last").remove() 
    }else{
        Snackbar.show({
            text: 'Minimal ada 1 baris ges.',
            // backgroundColor: '#fff',
            textColor: '#ff69b4',
            pos: 'top-right',
            duration: '2000',
            showAction: false,
        });
    }
})

$("#form-arwah").submit(function(e){
    e.preventDefault()
    data = $(this).serializeArray();
    data = JSON.stringify(data)
    auth = Cookies.get("auth");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: '/ajax',
        data: 'token='+auth+'&data=' + data,
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
                redirect('/dashboard/haul-massal/store')
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
    
})

$(document).ready(function(){
    autocomplete()
})