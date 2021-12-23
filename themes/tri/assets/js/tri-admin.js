jQuery(function ($) {

	/* Unlimited Sidebars */
	var sidebarForm = jQuery('#tri_add_sidebar_form'),
		sidebarFormNew = sidebarForm.clone();
	sidebarForm.remove();
	jQuery('#widgets-right').append('<div style="clear:both;"></div>').append(sidebarFormNew);
	sidebarFormNew.submit(function (e) {
		e.preventDefault();
		var data = {
			'action': 'tri_add_sidebar',
			'_wpnonce_tri_widgets': jQuery('#_wpnonce_tri_widgets').val(),
			'tri_sidebar_name': jQuery('#tri_sidebar_name').val()
		};
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function (response) {
				window.location.reload(true);
			},
			error: function (data) {
				console.log('error');
			}
		});
	});

	var delSidebar = '<button class="delete-sidebar"><span class="dashicons dashicons-trash"></span></button>';
	jQuery('.sidebar-tri_custom_sidebar').find('.sidebar-name .handlediv').after(delSidebar);
	jQuery('.delete-sidebar').click(function () {
		var confirmIt = confirm('Are you sure?');
		if ( !confirmIt ) {
			return;
		}
		var widgetBlock = jQuery(this).parent().parent().parent(),
			data = {
			'action': 'tri_delete_sidebar',
			'tri_sidebar_name': jQuery(this).parent().find('h2').text()
		};
		widgetBlock.hide();
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function (response) {
				widgetBlock.remove();
			},
			error: function (data) {
				alert('Error while deleting sidebar');
				widgetBlock.show();
			}
		});
	});
});