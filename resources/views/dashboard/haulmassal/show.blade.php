@extends('layout.dashboard')

@section('content')
<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mx-auto">
    <div class="card">
        <div class="card-header">        
            <h5 class="card-title mb-0">List Data</h5>
        </div>
        <div class="card-body py-1">
            <div id="table-responsives">
                <table class="table table-hover text-wrap mb-0">
                    <thead class="fw-bold">
                        <tr>
                            <td>No</td>
                            <td>Nama Pengirim</td>
                            <td>Alamat Pengirim</td>
                            <td>Nama Arwah</td>
                            <td>Makam Arwah</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="data-haul">
                        
                    </tbody>
                </table>
                <div class="d-flex mt-4 justify-content-center">
                    <div class="px-2 pagination">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script>
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
        console.log(data)
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
            table_haul_html += "<tr class='"+isOdd+"'><td>"+nomer+".</td><td>"+toTitleCase(v.name)+"</td><td>"+toTitleCase(v.address)+"</td>"
                $.each(v.arwahs, function(key, val){
                    option_html = "<span data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false' class='px-1 py-1'><i  class='fa-solid fa-ellipsis-vertical'></i></span>"
                    option_html += "<ul class='dropdown-menu'><li><a class='dropdown-item edit-sender' data-sender='"+v.id+"' href='#'><i class='align-middle me-1 fa-solid fa-pen'></i>Edit Pengirim</a></li>"
                        option_html += "<li><a class='dropdown-item edit-arwah' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-pen'></i>Edit Arwah</a></li>"
                        option_html += "<li><a class='dropdown-item add-arwah' detail-sender='"+v.name+"-"+v.address+"'  data-sender='"+v.id+"' href='#'><i class='align-middle me-1 fa-solid fa-plus'></i>Tambah Arwah</a></li>"
                        option_html += "<li><a class='dropdown-item delete-sender text-danger' detail-sender='"+v.name+"-"+v.address+"'  data-sender='"+v.id+"' href='#'><i class='align-middle me-1 fa-solid fa-trash-can'></i>Hapus Pengirim</a></li>"
                        option_html += "<li><a class='dropdown-item delete-arwah text-danger' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-trash-can'></i>Hapus Arwah</a></li>"
                        option_html += "</ul>"
                        
                        edit_delete_icon = "<span data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false' class='px-1 py-1'><i  class='fa-solid fa-ellipsis-vertical'></i></span>"
                        edit_delete_icon += "<ul class='dropdown-menu'><li><a class='dropdown-item edit-arwah' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-pen'></i>Edit Arwah</a></li>"
                            edit_delete_icon += "<li><a class='dropdown-item delete-arwah text-danger' data-arwah='"+val.id+"' href='#'><i class='align-middle me-1 fa-solid fa-trash-can'></i>Hapus Arwah</a></li>"
                            edit_delete_icon += "</ul>"
                            
                            no = key + 1
                            if(val.arwah_type == "Bapak"){
                                arwah_type = "Bp. "
                            }else if(val.arwah_type == "Ibu"){
                                arwah_type = "Ibu. "
                            }else if(val.arwah_type == "Saudara"){
                                arwah_type = "Sdr. "
                            }
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
            </script>
            
            @endsection