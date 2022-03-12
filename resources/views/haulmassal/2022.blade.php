@extends('layout.main')

@section('single-page-css')
<style>
    .bg-dashboard{
        background-color: #3330a3 !important;
        padding-top: 4rem !important;
        padding-bottom: 11rem !important;
    }
    .mt-negative{
        margin-top: -10rem !important;
    }
    .mb-10{
        margin-bottom: 4rem;
    }
    
    .card {
        word-wrap: break-word;
        background-clip: border-box;
        background-color: #fff;
        border: 0 solid transparent;
        border-color: 1px solid rgba(199, 199, 199, 0.192);
        border-radius: 0.25rem;
        display: flex;
        flex-direction: column;
        min-width: 0;
        position: relative;
        box-shadow: 4px 6px 21px 0px rgba(0,0,0,0.14);
        -webkit-box-shadow: 4px 6px 21px 0px rgba(0,0,0,0.14);
        -moz-box-shadow: 4px 6px 21px 0px rgba(0,0,0,0.14);
    }
    .card > hr {
        margin-left: 0;
        margin-right: 0;
    }
    .card > .list-group {
        border-bottom: inherit;
        border-top: inherit;
    }
    .card > .list-group:first-child {
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        border-top-width: 0;
    }
    .card > .list-group:last-child {
        border-bottom-left-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        border-bottom-width: 0;
    }
    .card > .card-header + .list-group,
    .card > .list-group + .card-footer {
        border-top: 0;
    }
    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-title {
        margin-bottom: 0.5rem;
    }
    .card-subtitle {
        margin-top: -0.25rem;
    }
    .card-subtitle,
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-link:hover {
        text-decoration: none;
    }
    .card-link + .card-link {
        margin-left: 1.25rem;
    }
    .card-header {
        background-color: #fff;
        border-bottom: 0 solid transparent;
        margin-bottom: 0;
        padding: 1rem 1.25rem;
    }
    .card-header:first-child {
        border-radius: 0.25rem 0.25rem 0 0;
    }
    .card-footer {
        background-color: #fff;
        border-top: 0 solid transparent;
        padding: 1rem 1.25rem;
    }
    .card-footer:last-child {
        border-radius: 0 0 0.25rem 0.25rem;
    }
    .card-header-tabs {
        border-bottom: 0;
        margin-bottom: -1rem;
        margin-left: -0.625rem;
        margin-right: -0.625rem;
    }
    .card-header-tabs .nav-link.active {
        background-color: #fff;
        border-bottom-color: #fff;
    }
    .card-header-pills {
        margin-left: -0.625rem;
        margin-right: -0.625rem;
    }
    .card-img-overlay {
        border-radius: 0.25rem;
        bottom: 0;
        left: 0;
        padding: 1rem;
        position: absolute;
        right: 0;
        top: 0;
    }
    .card-img,
    .card-img-bottom,
    .card-img-top {
        width: 100%;
    }
    .card-img,
    .card-img-top {
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }
    .card-img,
    .card-img-bottom {
        border-bottom-left-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    .card-group > .card {
        margin-bottom: 12px;
    }
    input[type='text']{
        height: 35px !important;
    }
    .btn {
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 0.2rem;
        color: #495057;
        cursor: pointer;
        display: inline-block;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        padding: 0.3rem 0.85rem;
        text-align: center;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        vertical-align: middle;
    }
</style>   
@endsection
@section('content')
<div class="bg-dashboard"></div>
<div class="container-fluid mt-negative w-100 mb-10">
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-4 col-4">
                        <h5 class="card-title mb-0 text-dark px-2 py-2">List Data</h5>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 col-8">
                        <div class="search-data">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari pengirim" id="search-data-public" aria-describedby="button-addon2">
                                <button class="btn btn-submit text-white" type="button" id="search-data-public-btn">Cari</button>
                            </div>
                            
                        </div>
                        {{-- <div class="d-flex justify-content-end">
                            <div class="download-xls text-dark">
                                <span>
                                    <a  href="#" id='download-data-haul' class="text-primary btn-download" >  Download Data <i class="fa-solid fa-download"></i></a>
                                </span>      
                            </div> 
                        </div>    --}}
                    </div>
                </div>
            </div>
            <div class="card-body py-1">
                <marquee behavior="" direction="" id="total-stats"></marquee>
                <div id="table-responsives" style="overflow: auto">
                    <table class="table table-hover text-nowrap table-sm table-haul mb-0">
                        <thead class="fw-bold">
                            <tr>
                                <td>No</td>
                                <td>Nama Pengirim</td>
                                <td>Alamat Pengirim</td>
                                <td>No</td>
                                <td>Nama Arwah</td>
                                <td>Makam Arwah</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="data-haul-public">
                            
                        </tbody>
                    </table>
                </div>
                <div class="d-flex mt-4 mb-4 justify-content-center">
                    <div id="no-data"></div>
                    <ul class="px-2 pagination pagination-sm">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('single-page-js')
<script src="{{asset('js/login.js')}}"></script>
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
                    no = key + 1
                    if(key == 0){
                        table_haul_html += "<td>"+no+".</td><td>"+arwah_type+toTitleCase(val.arwah_name.replace(/\,/g,'.'))+"</td><td>"+toTitleCase(val.arwah_address)+"</td><td></td></tr>"
                    }else{
                        table_haul_html += "<tr class='"+isOdd+"'><td colspan='3'></td><td>"+no+".</td><td>"+arwah_type+toTitleCase(val.arwah_name.replace(/\,/g,'.'))+"</td><td>"+toTitleCase(val.arwah_address)+"</td><td></td></tr>"
                    }
                })
                $("#data-haul-public").html(table_haul_html)
            })
        }
        
        $("#search-data-public-btn").on("click", function() {
            var value = $("#search-data-public").val().toLowerCase();
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
                        if (response.data != "") {
                            $("#no-data").html(" ");
                            $(".pagination").hide()
                            show_table_haul(response.data, 1);
                        } else {
                            $(".pagination").hide()
                            not_found = "<div class='d-flex mt-2 justify-content-center h5'>Maaf, data dengan nama " + value + " tidak ditemukan</div>"
                            $("#data-haul-public").html(" ");
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
                stats_html = ""
                stats_html += "<span>Total Pengirim: </span><span class='fw-bold text-dark'>"+response.data.total_sender + " Orang.&nbsp;&nbsp;</span>"
                stats_html += "<span>Total Arwah: </span><span class='fw-bold text-dark'>"+response.data.total_arwah + " Orang.</span>"
                $("#total-stats").html(stats_html)
            }
        })
        $(document).on("click", "#download-data-haul", function(e){
            e.preventDefault
            downloadUrl= api_server+"/api/nyadran/export"
            file_name = "Haul-Massal-2022"
            ExportFile(downloadUrl, file_name)
        })
    </script>
    @endsection