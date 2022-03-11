auth = Cookies.get("auth")
roles = Cookies.get("roles")
if(roles != 'Super Admin'){
    redirect('/dashboard/superadmin-area')
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: api_server+ "/api/admin/users",
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
        console.log(response)
        list_users_html = ""
        $.each(response.data, function(k, v){
            if(v.status == "ACTIVE"){
                status_text = "text-success"
            }else{
                status_text = "text-danger"
            }
            list_users_html += "<tr><td>"+v.name+"</td>"
            list_users_html += "<td>"+v.phone+"</td>"
            list_users_html += "<td>"+v.email+"</td>"
            list_users_html += "<td>"+v.roles[0].name+"</td>"
            list_users_html += "<td class='"+status_text+" fst-italic'>"+v.status+"</td><td><span data-id='"+v.id+"' detail-user='"+v.name+"' class='delete-users'><i class='fa-solid fa-trash-can text-danger'></i></span></td></tr>"
        })
        $("#list-users").html(list_users_html)
        $('#loading').addClass('hidden')
    }
})

$(document).on("click", ".delete-users", function(){
    user_id = $(this).attr("data-id")
    detail_user = $(this).attr("detail-user")
    $("#delete-user-btn").attr("data-id", user_id)
    $("#detail-user-name").text(detail_user)
    $("#delete-user-modal").modal("show")
})

$(document).on("click", "#delete-user-btn", function(){
    user_id = $(this).attr("data-id")
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
        url: api_server + "/api/admin/users/"+user_id+"/delete",
        method: "DELETE",
        timeout: 0,
        headers: {
            Accept: "application/json",
        },
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        success: function(response) {
            Snackbar.show({
                text: "Sukses Submit",
                // backgroundColor: '#fff',
                textColor: "#24D1BC",
                pos: "top-right",
                duration: "2000",
                showAction: false,
            });
            setTimeout(redirect, 500, '/dashboard/users/list-user');

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