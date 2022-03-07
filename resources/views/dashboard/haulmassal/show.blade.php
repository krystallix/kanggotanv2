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
                            <td>No</td>
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
        url: api_server + "/api/nyadran/all?per_page=2&page=1",
        cache: false,
        beforeSend: function() {
                $('#loading').removeClass('hidden')
            },
        success: function(response) {
            $('#loading').addClass('hidden')
            pageLength = response.data.last_page;
            //page
            // Number of items and limits the number of items per page
            var limitPerPage = 2;
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
                GetData(+$(this).text());
                return showPage(+$(this).text());
            });
            $("#next-page").on("click", function() {
                if (currentPage == totalPages) {
                    //nothing
                } else {
                    GetData(currentPage + 1);
                }
                return showPage(currentPage + 1);
            });
            $("#previous-page").on("click", function() {
                if (currentPage == 1) {
                    //nothing
                } else {
                    GetData(currentPage - 1);
                }
                return showPage(currentPage - 1);
            });
        },
    });
    
    function GetData(page){
        $.ajax({
            url: api_server + "/api/nyadran/all?per_page=2&page="+page,
            method: "GET",
            cache: false,
            beforeSend: function() {
                $('#loading').removeClass('hidden')
            },
            success: function(response) {
                $('#loading').addClass('hidden')
                data = response.data.data;
                show_table_haul(data)
            }
        })
    }

    function show_table_haul(data){
        console.log(data)
        table_haul_html = ""
        $.each(data, function(k,v){
            nomer = k+1
            table_haul_html += "<tr><td>"+nomer+".</td><td>"+v.name+"</td><td>"+v.address+"</td>"
            $.each(v.arwahs, function(key, val){
                no = key + 1
                if(val.arwah_type == "Bapak"){
                    arwah_type = "Bp. "
                }else if(val.arwah_type == "Ibu"){
                    arwah_type = "Ibu. "
                }else if(val.arwah_type == "Saudara"){
                    arwah_type = "Sdr. "
                }
                if(key == 0){
                    table_haul_html += "<td>"+no+".</td><td>"+arwah_type+val.arwah_name+"</td><td>"+val.arwah_address+"</td><td></td></tr>"
                }else{
                    table_haul_html += "<tr><td colspan='3'><td>"+no+".</td><td>"+arwah_type+val.arwah_name+"</td><td>"+val.arwah_address+"</td><td></td></tr>"
                }
            })
            $("#data-haul").html(table_haul_html)
        })
    }
    
</script>
@endsection