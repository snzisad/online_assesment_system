$(document).ready(function () {

    $(".error_messsage").hide();
    $(".progress_bar").hide();


    $(".btn_submit_login").on('click', function(){
        $id = $("#employee_id").val();

        if($id != ""){
            $(".error_messsage").hide();
            $(".progress_bar").show();
            $(".btn_submit_login").attr("disabled", true);

            var token = $("[name='_token']").val();
            var url = $("#login_form").attr("action");

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": token,
                    "employee_id": $id
                },
                success: function(response){
                    if(response.status){
                        var urlPath = response.redirect_url;
                        parent.location = urlPath;
                    }
                    else{
                        $(".error_messsage").show();
                    }

                },
                error: function(error){
                    $(".error_messsage").show();
                    console.log("error "+error);
                }
              });

                $(".progress_bar").hide();
                $(".btn_submit_login").attr("disabled", false);


            return false;
        }

        return true;
    });

});