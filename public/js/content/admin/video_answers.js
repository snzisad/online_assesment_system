$(document).ready(function () {


    $(".btn_view_video_answers").on('click', function(){
        $id = $(this).attr("content");
        $title = $(this).closest("tr").find(".employee_name").text();
        $("#employee_name2").text($title);

        if($id != ""){
            
            $('.video_answer_section_modal').modal('hide');
            $('.progressbar_modal').modal('show');

            var url = $(".video_answer_section_modal").attr("action");

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    "employee_id": $id
                },
                success: function(response){
                    var response = jQuery.parseJSON(response);

                    if(response.status){
                        var answers = response.answers;
                        setQuestionAnswers(answers);
                    }

                },
                error: function(error){
                    $(".error_messsage").show();
                    console.log(error);
                }
            });

            $('.progressbar_modal').modal('hide');
            return false;
        }

        return true;
    });

    function setQuestionAnswers($questions){
        console.log($questions);
        $options_html = "";

        for($i=0; $i<$questions.length; $i++){
            $answer = $questions[$i];
            $question = $answer["question"];
            
            $options_html+="<h4 style=\"color: #000;\">Question: "+($i+1)+"</h4>";
            $options_html+="<p><b>Case: </b>"+$question["title"]+"</p>";
            $options_html+="<p><b>Role: </b>"+$question["role"]+"</p>";
            $options_html+="<p style=\"text-align: center;\"><video  height=\"240\" controls><source src=\"/videos/url/"+$answer["video"]+"\">Your browser does not support the video tag.</video></p>";
            
        }

        $(".question_section").html($options_html);

        $('.progressbar_modal').modal('hide');
        setTimeout(function() {
            $('.video_answer_section_modal').modal('show');
        }, 500);
    }

});