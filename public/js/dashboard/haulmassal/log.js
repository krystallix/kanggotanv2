auth = Cookies.get('auth')
$.ajax({
    url: api_server+ "/api/admin/logs",
    headers: {
        "Accept": "application/json"
    },
    method: "GET",
    timeout: 0,
    dataType: "json",
    beforeSend: function(xhr) {
        $('#loading').removeClass('hidden')
        xhr.setRequestHeader("Authorization", "Bearer " + auth);
    },
    success: function(response){
        log_html = ""
        $.each(response.data, function(k, v){
            date = new Date(v.created_at);
            timestamps = date.toUTCString()
            if(v.action.toLowerCase() == "create arwah"){
                text_action = "create"
                action = "create data"
            }if(v.action.toLowerCase() == "edit sender"){
                text_action = "edit"
                action = "edit sender"
            }if(v.action.toLowerCase() == "destroy sender"){
                text_action = "destroy"
                action = "destroy data"
            }if(v.action.toLowerCase() == "add arwah by sender"){
                text_action = "add"
                action = "add arwah"
            }if(v.action.toLowerCase() == "edit arwah"){
                text_action = "edit"
                action = "edit arwah"
            }
            data = JSON.parse(v.data)
            if(k>=35){
                if(v.action.toLowerCase() == "add arwah by sender"){
                    log_html += "<span><span class='dollar'>$</span><span class='timestamps'>["+timestamps+"]</span> - <span class=''>"+v.user+"</span> <span class='"+text_action+"'>"+action.toLowerCase()+"</span> for sender id <span class='sender-name'>'"+data[0].sender_id+"'</span></span><br>"
                }
                if(v.action.toLowerCase() == "edit arwah"){
                    log_html += "<span><span class='dollar'>$</span><span class='timestamps'>["+timestamps+"]</span> - <span class=''>"+v.user+"</span> <span class='"+text_action+"'>"+action.toLowerCase()+"</span> for sender id <span class='sender-name'>'"+data.sender_id+"'</span></span><br>"
                }if(v.action.toLowerCase() == "create arwah"){
                    log_html += "<span><span class='dollar'>$</span><span class='timestamps'>["+timestamps+"]</span> - <span class=''>"+v.user+"</span> <span class='"+text_action+"'>"+action.toLowerCase()+"</span> with sender name <span class='sender-name'>'"+toTitleCase(data.name)+"'</span></span><br>"
                }if(v.action.toLowerCase() == "edit sender"){
                    log_html += "<span><span class='dollar'>$</span><span class='timestamps'>["+timestamps+"]</span> - <span class=''>"+v.user+"</span> <span class='"+text_action+"'>"+action.toLowerCase()+"</span> with sender name <span class='sender-name'>'"+toTitleCase(data.name)+"'</span></span><br>"
                }if(v.action.toLowerCase() == "destroy sender"){
                    log_html += "<span><span class='dollar'>$</span><span class='timestamps'>["+timestamps+"]</span> - <span class=''>"+v.user+"</span> <span class='"+text_action+"'>"+action.toLowerCase()+"</span> with sender name <span class='sender-name'>'"+toTitleCase(data.name)+"'</span></span><br>"
                }
            }
            $("#log-data").html(log_html)
            if($(".timestamps").length == 0){
                $('#loading').removeClass('hidden')
            }else{
                $('#loading').addClass('hidden')
                window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
            }            
        })
    }
})

$("#go-up").keyup(function(){
    window.scrollTo({ left: 0, top: 0, behavior: "smooth" });
})