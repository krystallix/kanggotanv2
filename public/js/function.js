function redirect(url) {
    $(location).prop('href', url)
}

function LoggedIn(){
    $('#signin-btn').addClass("hidden")
    $('#signout-btn').removeClass("hidden")
}

function LoggedOut(){
    $('#signin-btn').removeClass("hidden")
    $('#signout-btn').addClass("hidden")
}

$(document).ready(function(){
    username = Cookies.get('auth')
    if(username != null){
        LoggedIn()
    }else{
        LoggedOut()
    }
})