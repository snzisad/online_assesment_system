$(document).ready(function () {

    // $(".error_messsage").hide();
    $(".progress_bar").hide();

    $(".btn_upload_results").on('click', function(){

        $(".modal-title").text("Uploading data...");
        $(".progress_bar").show();
        $(".btn_upload_results").hide();
        // var urlPath = "/thank_you";
        // parent.location = urlPath;


        var mcq_quations_interval_time = 3;
        var mcq_quations_interval = setInterval(function(){
            mcq_quations_interval_time = mcq_quations_interval_time-1;
            
            if(mcq_quations_interval_time<=0){
                clearInterval(mcq_quations_interval);
                
                var urlPath = "/thank_you";
                parent.location = urlPath;
            }
        }, 1000);
        
        return true;
    });

});