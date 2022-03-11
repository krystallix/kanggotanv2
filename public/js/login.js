$(document).on("click", "#signin-btn", function(e){
    e.preventDefault();
    $("#signin-modal").modal("show")
})

$(document).on("click", ".signout-btn", function(e){
    e.preventDefault();
    Cookies.remove('username')
    Cookies.remove('auth')
    redirect('/')
})

$("#signin-form").submit(function(e){
    e.preventDefault()
    data = new FormData(this)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'accept': 'application/json'
        }
    });
    $.ajax({
        url: api_server+"/api/auth/login",
        timeout: 0,
        headers: {
          "Accept": "application/json"
        },
        mimeType: 'multipart/form-data',
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#loading').removeClass('hidden')
        },
        success: function (result) {
            $('#loading').addClass('hidden')
            $("#signin-modal").modal("hide")
            Snackbar.show({
                text: 'Login Success',
                backgroundColor: '#fff',
                textColor: '#24D1BC',
                pos: 'top-right',
                duration: '2000',
                showAction: false,
            });
            result= JSON.parse(result)
            auth = result.data.token
            username = result.data.user.name
            roles = result.data.user.roles[0].name
            Cookies.set("roles", roles, {expires: 1})
            Cookies.set("auth", auth, { expires: 1 });
            Cookies.set("username", username, { expires: 1 });
            redirect('/dashboard')
        },
        error: function (xhr) {
            $('#loading').addClass('hidden')
            Snackbar.show({
                text: 'Login Failed',
                // backgroundColor: '#fff',
                textColor: '#ff69b4',
                pos: 'top-right',
                duration: '2000',
                showAction: false,
            });
        }
    });
})

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});