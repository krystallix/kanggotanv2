auth = Cookies.get("auth")
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: api_server+ "/api/admin/roles",
    headers: {
        "Accept": "application/json"
    },
    mimeType: 'multipart/form-data',
    type: "GET",
    processData: false,
    contentType: false,
    dataType: "json",
    beforeSend: function() {
        $('#loading').removeClass('hidden')
    },
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + auth);
    },
    success: function(response){
        $('#loading').addClass('hidden')
        select_roles_html = ""
        $.each(response.data, function(k,v){
            select_roles_html += "<option value='"+v.name+"'>"+v.name+"</option>"
        })
        $("#option_role").after(select_roles_html)
    }
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

$("#create-user-form").submit(function(e){
    e.preventDefault()
    data = new FormData(this)
    auth = Cookies.get("auth");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            accept: "application/json",
        },
    });
    $.ajax({
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + auth);
        },
        url: api_server + "/api/admin/users/store",
        method: "POST",
        timeout: 0,
        headers: {
            Accept: "application/json",
        },
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: data,
        success: function(response) {
            Snackbar.show({
                text: "Sukses Submit",
                // backgroundColor: '#fff',
                textColor: "#24D1BC",
                pos: "top-right",
                duration: "2000",
                showAction: false,
            });
            setTimeout(redirect, 500, '/dashboard/users/create-user');

        },
        error: function(xhr) {
            Snackbar.show({
                text: "Gagal Submit, coba kembali nanti atau hubungi pengembang.",
                // backgroundColor: '#fff',
                textColor: "#ff69b4",
                pos: "top-right",
                duration: "2000",
                showAction: false,
            });
        },
    });
})