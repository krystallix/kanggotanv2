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

// title case capital 
function toTitleCase(str) {
	return str.replace(/\w\S*/g, function(txt) {
		return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	});
}

//pagination
function getPageList(totalPages, page, maxLength) {
	if (maxLength < 5) throw "maxLength must be at least 5";

	function range(start, end) {
		return Array.from(Array(end - start + 1), (_, i) => i + start);
	}
	var sideWidth = maxLength < 9 ? 1 : 2;
	var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
	var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;
	if (totalPages <= maxLength) {
		// no breaks in list
		return range(1, totalPages);
	}
	if (page <= maxLength - sideWidth - 1 - rightWidth) {
		// no break on left of page
		return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
	}
	if (page >= totalPages - sideWidth - 1 - rightWidth) {
		// no break on right of page
		return range(1, sideWidth).concat(0, range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
	}
	// Breaks on both sides
	return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
}