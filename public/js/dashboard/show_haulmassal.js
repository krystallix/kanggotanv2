$.ajax({
    url: api_server + "/api/nyadran/all?per_page=100&page=1",
    cache: false,
    beforeSend: function() {
        $('#loading').removeClass('hidden')
    },
    success: function(response) {
        $('#loading').addClass('hidden')
        pageLength = response.data.last_page;
        //page
        // Number of items and limits the number of items per page
        var limitPerPage = 100;
        // Total pages rounded upwards
        var totalPages = pageLength;
        // Number of buttons at the top, not counting prev/next,
        // but including the dotted buttons.
        // Must be at least 5:
        var paginationSize = 6;
        var currentPage;
        
        function showPage(whichPage) {
            if (whichPage < 1 || whichPage > totalPages) return false;
            currentPage = whichPage;
            // Replace the navigation items (not prev/next):
            $(".pagination li").slice(1, -1).remove();
            getPageList(totalPages, currentPage, paginationSize).forEach(
                (item) => {
                    $("<li>").addClass("page-item").addClass(item ? "current-page" : "disabled").toggleClass("active", item === currentPage).append($("<a>").addClass("page-link").attr({
                        href: "javascript:void(0)",
                    }).text(item || "...")).insertBefore("#next-page");
                });
                // Disable prev/next when at first/last page:
                $("#previous-page").toggleClass("disabled", currentPage === 1);
                $("#next-page").toggleClass("disabled", currentPage === totalPages);
                return true;
            }
            // Include the prev/next buttons:
            $(".pagination").append($("<li>").addClass("page-item").attr({
                id: "previous-page"
            }).append($("<a>").addClass("page-link").attr({
                href: "javascript:void(0)",
            }).append("<i class='fa-solid fa-chevron-left'></i>")), $("<li>").addClass("page-item").attr({
                id: "next-page"
            }).append($("<a>").addClass("page-link").attr({
                href: "javascript:void(0)",
            }).append("<i class='fa-solid fa-chevron-right'></i>")));
            // Show the page links
            showPage(1);
            GetData(1);
            // Use event delegation, as these items are recreated later
            $(document).on("click", ".pagination li.current-page:not(.active)", function() {
                GetData(+$(this).text(), limitPerPage);
                return showPage(+$(this).text());
            });
            $("#next-page").on("click", function() {
                if (currentPage == totalPages) {
                    //nothing
                } else {
                    GetData(currentPage + 1, limitPerPage);
                }
                return showPage(currentPage + 1);
            });
            $("#previous-page").on("click", function() {
                if (currentPage == 1) {
                    //nothing
                } else {
                    GetData(currentPage - 1, limitPerPage);
                }
                return showPage(currentPage - 1);
            });
        },
    });
    
    function GetData(page, limit){
        $.ajax({
            url: api_server + "/api/nyadran/all?per_page=100&page="+page,
            method: "GET",
            cache: false,
            beforeSend: function() {
                $('#loading').removeClass('hidden')
            },
            success: function(response) {
                $('#loading').addClass('hidden')
                data = response.data.data;
                show_table_haul(data, page, limit)
            }
        })
    }
    
    function show_table_haul(data, page, limit){
        table_haul_html = ""
        if (page == 1) {
            nomer = 0;
        } else {
            nomer = (page - 1) * limit;
        }
        $.each(data, function(k,v){
            if (k % 2 === 0) {
                isOdd = "odd";
            } else {
                isOdd = "even";
            }
            nomer = nomer + 1
            table_haul_html += "<tr class='"+isOdd+"'><td>"+nomer+".</td><td>"+toTitleCase(v.name)+"</td><td>"+toTitleCase(v.address)+"</td>";
            $.each(v.arwahs, function(key, val){
                no = key + 1
                if(val.arwah_type == "Bapak"){
                    arwah_type = "Bp. "
                }else if(val.arwah_type == "Ibu"){
                    arwah_type = "Ibu. "
                }else if(val.arwah_type == "Saudara"){
                    arwah_type = "Sdr. "
                }else if(val.arwah_type == "Adik"){
                    arwah_type = "Adik. "
                }
                option_html = "<span data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false' class='px-1 py-1'><i  class='fa-solid fa-ellipsis-vertical'></i></span>"
                option_html += "<ul class='dropdown-menu'><li><a class='dropdown-item edit-sender' data-sender='"+v.id+"' href='#'><i class='align-middle me-1 fa-solid fa-pen'></i>Edit Pengirim</a></li>"
                option_html += "<li><a class='dropdown-item edit-arwah' detail-sender='"+v.name+"' data-arwah='"+val.id+"'  detail-arwah='"+val.arwah_type+"-"+val.arwah_name+"-"+val.arwah_address+"' href='#'><i class='align-middle me-1 fa-solid fa-pen'></i>Edit Arwah</a></li>"
                option_html += "<li><a class='dropdown-item add-arwah' detail-sender='"+v.name+"-"+v.address+"'  data-sender='"+v.id+"' href='#'><i class='align-middle me-1 fa-solid fa-plus'></i>Tambah Arwah</a></li>"
                option_html += "<li><a class='dropdown-item delete-sender text-danger' detail-sender='"+v.name+"-"+v.address+"'  data-sender='"+v.id+"' href='#'><i class='align-middle me-1 fa-solid fa-trash-can'></i>Hapus Pengirim</a></li>"
                option_html += "<li><a class='dropdown-item delete-arwah text-danger' detail-arwah='"+arwah_type+" "+val.arwah_name+"-"+val.arwah_address+"' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-trash-can'></i>Hapus Arwah</a></li>"
                option_html += "</ul>"
                
                edit_delete_icon = "<span data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false' class='px-1 py-1'><i  class='fa-solid fa-ellipsis-vertical'></i></span>"
                edit_delete_icon += "<ul class='dropdown-menu'><li><a class='dropdown-item edit-arwah' detail-sender='"+v.name+"'  detail-arwah='"+val.arwah_type+"-"+val.arwah_name+"-"+val.arwah_address+"' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-pen'></i>Edit Arwah</a></li>"
                edit_delete_icon += "<li><a class='dropdown-item delete-arwah text-danger' detail-arwah='"+arwah_type+" "+val.arwah_name+"-"+val.arwah_address+"' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-trash-can'></i>Hapus Arwah</a></li>"
                edit_delete_icon += "</ul>"
                
                
                if(key == 0){
                    table_haul_html += "<td>"+arwah_type+toTitleCase(val.arwah_name)+"</td><td>"+toTitleCase(val.arwah_address)+"</td><td>"+option_html+"</td></tr>"
                }else{
                    table_haul_html += "<tr class='"+isOdd+"'><td colspan='3'><td>"+arwah_type+toTitleCase(val.arwah_name)+"</td><td>"+toTitleCase(val.arwah_address)+"</td><td>"+edit_delete_icon+"</td></tr>"
                }
            })
            $("#data-haul").html(table_haul_html)
        })
    }
    
    $(document).on("click", ".delete-sender", function(e){
        e.preventDefault()
        id = $(this).attr('data-sender')
        detail_sender = $(this).attr('detail-sender')
        detail_sender = detail_sender.split('-')
        $('#delete-sender-btn').attr('data-id', id)
        $("#detail-sender-name").text(toTitleCase(detail_sender[0]))
        $("#detail-sender-address").text(toTitleCase(detail_sender[1]) + '?')
        $("#delete-sender-modal").modal('show')
    })
    
    $(document).on("click", "#delete-sender-btn", function(){
        auth = Cookies.get('auth')
        id_sender = $(this).attr('data-id')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method: 'DELETE',
            url: api_server + "/api/nyadran/sender/"+id_sender+"/delete",
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
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + auth);
            },
            success: function (msg) {
                $('#loading').addClass('hidden')
                Snackbar.show({
                    text: 'Submit Data Success',
                    // backgroundColor: '#fff',
                    textColor: '#24D1BC',
                    pos: 'top-right',
                    duration: '2000',
                    showAction: false,
                });
                redirect('/dashboard/haul-massal/show')
            },
            error: function (msg, textStatus) {
                $('#loading').addClass('hidden')
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
    
    $(document).on("click", ".delete-arwah", function(e){
        e.preventDefault();
        id_arwah = $(this).attr('data-arwah')
        detail_arwah = $(this).attr('detail-arwah')
        detail_arwah = detail_arwah.split("-")
        $('#delete-arwah-btn').attr('data-id', id_arwah)
        $("#detail-arwah-name").text(toTitleCase(detail_arwah[0]))
        $("#detail-arwah-address").text(toTitleCase(detail_arwah[1]) + '?')
        $("#delete-arwah-modal").modal('show')
    })
    
    $(document).on("click", "#delete-arwah-btn", function(){
        auth = Cookies.get('auth')
        id_arwah = $(this).attr('data-id')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method: 'DELETE',
            url: api_server + "/api/nyadran/arwah/"+id_arwah+"/delete",
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
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + auth);
            },
            success: function (msg) {
                $('#loading').addClass('hidden')
                Snackbar.show({
                    text: 'Submit Data Success',
                    // backgroundColor: '#fff',
                    textColor: '#24D1BC',
                    pos: 'top-right',
                    duration: '2000',
                    showAction: false,
                });
                redirect('/dashboard/haul-massal/show')
            },
            error: function (msg, textStatus) {
                $('#loading').addClass('hidden')
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
    
    $(document).on("click", ".add-arwah", function(e){
        e.preventDefault()
        id_sender = $(this).attr("data-sender")
        detail_sender = $(this).attr('detail-sender')
        detail_sender = detail_sender.split('-')
        $("#form-add-arwah").attr('data-id', id_sender)
        $("#detail-add-arwah").html("<span>Nama : "+detail_sender[0]+ "</span><br><span> Alamat : " + detail_sender[1]+"</span>")
        $("#add-arwah-modal").modal('show')
    })
    
    i = 1
    $(document).on("click", "#add-row-btn-modal", function(){
        i++
        div_arwah = $(".div-arwah-modal").html()
        div_arwah_html = "<div class='div-arwah-modal' id='div-arwah-modal-"+i+"'>"+div_arwah+"</div>"
        total_row = $("#total-row-modal").val()
        for(k=0; k<total_row; k++){
            $("#add-remove-row-modal").before(div_arwah_html)    
        }
    })
    
    $(document).on("click", "#remove-row-btn-modal", function(){
        div_arwah_length = $('div.div-arwah-modal').length 
        if(div_arwah_length > 1){
            $("div.div-arwah-modal:last").remove() 
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
    
    $("#form-add-arwah").submit(function(e){
        e.preventDefault()
        id_sender = $(this).attr('data-id')
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
            url: '/ajax/add',
            data: 'token='+auth+'&data=' + data+'&id_sender='+id_sender,
            beforeSend: function() {
                $('#loading').removeClass('hidden')
            },
            success: function (msg) {
                $('#loading').addClass('hidden')
                msg = JSON.parse(msg)
                console.log(JSON.stringify(msg))
                if(msg.code==200){
                    Snackbar.show({
                        text: 'Submit Data Success',
                        // backgroundColor: '#fff',
                        textColor: '#24D1BC',
                        pos: 'top-right',
                        duration: '2000',
                        showAction: false,
                    });
                    redirect('/dashboard/haul-massal/show')
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
    
    $(document).on("click", ".edit-arwah", function(e){
        e.preventDefault()
        id_arwah = $(this).attr('data-arwah')
        detail_arwah = $(this).attr('detail-arwah')
        detail_sender = $(this).attr('detail-sender')
        detail_arwah = detail_arwah.split("-")
        $(".select-arwahtype option[value='"+detail_arwah[0]+"']").attr('selected','selected');
        $("#arwahs_name").val(detail_arwah[1])
        $("#arwah_address").val(detail_arwah[2])
        $("#edit-detail").text(detail_sender)
        $("#form-edit-arwah").attr("data-id", id_arwah)
        $("#edit-arwah-modal").modal("show")
    })
    
    $("#form-edit-arwah").submit(function(e){
        e.preventDefault()
        arwah_name_val = $("#arwahs_name").val()
        arwah_address_val = $("#arwah_address").val()
        arwah_type_val = $(".select-arwahtype option:selected").val()
        data = new Object
        data.arwah_name = arwah_name_val
        data.arwah_address = arwah_address_val
        data.arwah_type = arwah_type_val
        data = JSON.stringify(data)
        console.log(data)
        id_arwah = $(this).attr("data-id")
        auth = Cookies.get('auth')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method: 'PUT',
            url: api_server + "/api/nyadran/arwah/"+id_arwah+"/edit",
            timeout: 0,
            headers: {
                "Accept": "application/json"
            },
            type: "POST",
            data: data,
            contentType: "application/json",
            dataType: "json",
            beforeSend: function() {
                $('#loading').removeClass('hidden')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + auth);
            },
            success: function (msg) {
                console.log(data)
                console.log(msg)
                $('#loading').addClass('hidden')
                Snackbar.show({
                    text: 'Submit Data Success',
                    // backgroundColor: '#fff',
                    textColor: '#24D1BC',
                    pos: 'top-right',
                    duration: '2000',
                    showAction: false,
                });
                redirect('/dashboard/haul-massal/show')
            },
            error: function (msg, textStatus) {
                $('#loading').addClass('hidden')
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
    
    $("#search-data-btn").on("click", function() {
        var value = $("#search-data").val().toLowerCase();
        if (value != "") {
            var form = new FormData();
            form.append("name", value);
            $.ajax({
                method: 'POST',
                url: api_server + "/api/nyadran/search",
                timeout: 0,
                headers: {
                    "Accept": "application/json"
                },
                type: "POST",
                data: form,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('#loading').removeClass('hidden')
                },
                success: function (response) {
                    $('#loading').addClass('hidden')
                    console.log(response.data)
                    if (response.data != "") {
                        $("#no-data").html(" ");
                        $(".pagination").hide()
                        show_table_haul(response.data, 1);
                    } else {
                        $(".pagination").hide()
                        not_found = "<div class='d-flex mt-2 justify-content-center h5'>Maaf, data dengan nama " + value + " tidak ditemukan</div>"
                        $("#data-haul").html(" ");
                        $("#no-data").html(not_found);
                    }
                }
            });
        } else {
            $("#no-data").html(" ");
            $(".pagination").show()
            GetData(1)
        }
    });
    
    $.ajax({
        url: api_server+"/api/nyadran/statistik",
        method: "get",
        timeout: 0,
        success: function(response){
            $("#total-sender").text("Total Pengirim : "+response.data.total_sender + " Orang.")
            $("#total-arwah").text("Total Arwah : "+response.data.total_arwah + " Orang")
        }
    })
    
    $(document).on("click", "#download-data-haul", function(e){
        e.preventDefault
        downloadUrl= api_server+"/api/nyadran/export"
        file_name = "Haul-Massal-2022"
        ExportFile(downloadUrl, file_name)
    })