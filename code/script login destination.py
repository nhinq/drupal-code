jQuery('a[href="/user/login"]').each(function(){
		var wloc = window.location.pathname,
			link = "/user/login?destination="+ wloc;
		jQuery(this).attr("href",link);
	});