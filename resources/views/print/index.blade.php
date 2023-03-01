<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/essentials.css')}}">
    <title>Document</title>
</head>
<body>
    <table class="table table-sm table-bordered">
        <thead>
            <td>No</td>
            <td>Nama</td>
            <td>Alamat</td>
            <td>No</td>
            <td>Nama Arwah</td>
            <td>Makam</td>
        </thead>
        <tbody id="tbody-print">

        </tbody>
    </table>
    <div class="d-flex mt-4 mb-4 justify-content-center">
        <div id="no-data"></div>
        <ul class="px-2 pagination pagination-sm">
        </ul>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script src="{{asset('js/config.js')}}"></script>
<script src="{{asset('js/function.js')}}"></script>
<script>
    
    $.ajax({
        url: api_server + "/api/nyadran/all?year=2023&per_page=20&page=1",
        cache: false,
        beforeSend: function() {
            $('#loading').removeClass('hidden')
        },
        success: function(response) {
            $('#loading').addClass('hidden')
            pageLength = response.data.last_page;
            //page
            // Number of items and limits the number of items per page
            var limitPerPage = 20;
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
            url: api_server + "/api/nyadran/all?year=2023&per_page=20&page="+page,
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
                        table_haul_html += "<td>"+no+".</td><td>"+arwah_type+toTitleCase(val.arwah_name.replace(/\,/g,'.'))+"</td><td>"+toTitleCase(val.arwah_address)+"</td></tr>"
                    }else{
                        table_haul_html += "<tr class='"+isOdd+"'><td colspan=''></td><td></td><td></td><td>"+no+".</td><td>"+arwah_type+toTitleCase(val.arwah_name.replace(/\,/g,'.'))+"</td><td>"+toTitleCase(val.arwah_address)+"</td></tr>"
                    }
                })
                $("#tbody-print").html(table_haul_html)
            })
        }
    </script>
</html>