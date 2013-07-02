var sessionid = '';
var viewcount = 0;

$(document).ready(function() {
	
	var failure = function (data) {
		
		console.log(data);
		return false;
		
	};
	
	$('#first_timer').click(function() {
		
		$.ajax({
			type: 'POST',
			url: 'https://stage.syncaccess.net:443/po/rg/api/svcs/meter/standard?format=json',
			data: {
				sessionId: "",
				userID: "",
				contentId: "3",
				externalId: "",
				referrer: "",
				clientInfo: "TEST"
			},
			async: false,
			success: function(data) {
				console.log('Success:', data);
				sessionid = data.sessionIdentifier;
				$("#SessionId").text("SessionId: " + sessionid);
				$("#ViewCount").text("Remaining View Count: " + response.remainingViewCount);
			},
			error: failure
		});
		
		return false;
		
	});
	
	$('#returner').click(function() {
		
		$.ajax({
			type: 'POST',
			url: 'https://stage.syncaccess.net:443/po/rg/api/svcs/meter/standard?format=json',
			data: {
				sessionId: sessionid,
				userID: "",
				contentid: "3",
				contentId: "",
				referrer: "",
				clientInfo: "TEST"
			},
			async: false,
			success: function(response) {
				console.log('Success:', response);
				$('#ViewCount').text('Remaining View Count: ' + response.remainingViewCount);
			},
			error: failure
			
		});
		
	});
	
	$("#reset").click(function() {
		
		$('#SessionId').text('SessionId: _');
		sessionid = '';
		$("#ViewCount").text('Remaining View Count: _');
		viewcount = 0;
		
	});
	
});
