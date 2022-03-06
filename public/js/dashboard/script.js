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