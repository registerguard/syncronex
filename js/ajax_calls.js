   var sessionid = "";
   var viewcount = 0;
  
  
   $(document).ready(function () {

    /*** Failure ***/
    var failure = function (data) { alert(JSON.stringify(data)); return false; }; 
    
    /*** Initial Paymeter Call ***/
    $("#first_timer").click(function(){
         $.ajax({   type: 'POST',
                    url: 'http://localhost:51751/svcs/meter/standard?format=json',
                    data: {SessionId: "", UserId: "", ContentId: "3", ExternalId: "", Referrer: "", ClientInfo: "iPad" },
                    async: false,
                    success: function(data){
                        alert(JSON.stringify(data));
                        sessionid = data.sessionIdentifier;
                        $("#SessionId").text("SessionId: " + sessionid);
                        $("#ViewCount").text("Remaining View Count: " + response.remainingViewCount);
                    },
                    error: failure
                });
     return false;
    }); // end First Timer
    
    /*** Subsequent Paymeter Call ***/
    $("#returner").click(function(){
         $.ajax({   type: 'POST',
                    url: 'http://localhost:51751/svcs/meter/standard?format=json',
                    data: {SessionId: sessionid, UserId: "", ContentId: "3", ExternalId: "", Referrer: "", ClientInfo: "iPad" },
                    async: false,
                    success: function(response){
                        alert(JSON.stringify(response));
                        $("#ViewCount").text("Remaining View Count: " + response.remainingViewCount);
                    },
                    error: failure
                });

      
    }); // end returner 
    
    
    /*** Reset ***/
    $("#reset").click(function(){
      $("#SessionId").text("SessionId: _");
      sessionid = "";
      $("#ViewCount").text("Remaining View Count: _");
      viewcount = 0;
      
    }); // end reset

  });    /* end document.ready */
 