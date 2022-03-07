i = 1
$(document).on("click", "#add-row-btn", function(){
    i++
    div_arwah = $(".div-arwah").html()
    div_arwah_html = "<div class='div-arwah' id='div-arwah-"+i+"'>"+div_arwah+"</div>"
    $("#add-remove-row").before(div_arwah_html)    
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
    console.log(data)
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