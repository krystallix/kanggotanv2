$(document).on("click", ".signout-btn", function(e){
    e.preventDefault();
    Cookies.remove('username')
    Cookies.remove('auth')
    redirect('/')
})


$(document).ready(function(){
    username = Cookies.get('username')
    $("#username-text").text(username)
})

auth = Cookies.get("auth")
if(auth == null || auth == undefined || auth == ""){
    redirect('/')   
}

auth = Cookies.get("auth");
auth = Cookies.get('auth')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});    
$.ajax({
    method: 'GET',
    url: api_server + "/api/user",
    timeout: 0,
    headers: {
        "Accept": "application/json"
    },
    contentType: "application/json",
    beforeSend: function() {
        $('#loading').removeClass('hidden')
    },
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + auth);
    },
    success: function (msg) {
        $('#loading').addClass('hidden')
        console.log(msg)
    },
    error: function(xhr){
        response = JSON.parse(xhr.responseText)
        if(response.message == "Unauthenticated."){
            Snackbar.show({
                text: 'Token Expired, silahkan login ulang.',
                // backgroundColor: '#fff',
                textColor: '#f35b50',
                pos: 'top-right',
                duration: '2000',
                showAction: false,
            });
            Cookies.remove("auth")
            Cookies.remove("user")
            Cookies.remove("role")
            setTimeout(redirect, 500, '/')
        }
    }
});
