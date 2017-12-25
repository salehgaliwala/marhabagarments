jQuery(document).ready(function() {
    jQuery('a[href="#navbar-more-show"], .navbar-more-overlay').on('click', function(event) {
		event.preventDefault();
		jQuery('body').toggleClass('navbar-more-show');
		if (jQuery('body').hasClass('navbar-more-show'))	{
			jQuery('a[href="#navbar-more-show"]').closest('li').addClass('active');
		}else{
			jQuery('a[href="#navbar-more-show"]').closest('li').removeClass('active');
		}
		return false;
	});
});