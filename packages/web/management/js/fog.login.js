/****************************************************
 * FOG Login JS
 *	Author:		Blackout
 *	Created:	2:58 PM 20/04/2011
 *	Revision:	$Revision: 817 $
 *	Last Update:	$LastChangedDate: 2011-12-04 19:03:16 -0500 (Sun, 04 Dec 2011) $
 ***/

$(function()
{
	// Process FOG JS Variables
	$('.fog-variable').fogVariable();
	
	// Process FOG Message Boxes
	$('.fog-message-box').fogMessageBox();
	
	var ReturnIndexes = new Array('sites', 'version');
	var ResultContainers = $('#login-form-info b');
	
	$.ajax({
		'url':		'ajax/login.info.php',
		'cache':	false,
		'dataType':	'json',
		'success':	function (data)
		{
			for (i in ReturnIndexes)
			{
				var Container = ResultContainers.eq(i);
				
				if (data['error-' + ReturnIndexes[i]])
				{
					Container.html(data['error-' + ReturnIndexes[i]]);
				}
				else
				{
					Container.html(data[ReturnIndexes[i]]);
				}
			}
		},
		'error':	function()
		{
			ResultContainers.find('span').removeClass().addClass('icon icon-kill').attr('title', 'Failed to connect!');
		}
	});
	
	$('#username').select().focus();
});
