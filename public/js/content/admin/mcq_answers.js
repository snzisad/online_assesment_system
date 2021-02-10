$(document).ready(function () {



    $(".btn_view_answers").on('click', function(){
        $id = $(this).attr("content");
        $title = $(this).closest("tr").find(".employee_name").text();   
        $mark = $(this).closest("tr").find(".employee_mark").text();

        $content = $title+" (Mark: "+$mark+")";
        $("#employee_name").text($content);

        if($id != ""){
            
            $('.answer_section_modal').modal('hide');
            $('.progressbar_modal').modal('show');

            var url = $(".answer_section_modal").attr("action");

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
        $options_html = "";

        for($i=0; $i<$questions.length; $i++){
            $question = $questions[$i]["question"];
            $options = $questions[$i]["question"]['options'];
            $checked_option = $questions[$i]["option_id"];

            if($questions[$i]['mark'] == 1){
                $options_html+="<h4 style=\"color: #209e1c\">"+($i+1)+". "+$question["title"]+" <i class=\"fa fa-check\"></i></h4>";
            }
            else{
                $options_html+="<h4 style=\"color: red\">"+($i+1)+". "+$question["title"]+" <i class=\"fa fa-close\"></i></h4>";
            }
            $options_html+="<ol type=\"i\">";

            for($j=0; $j<$options.length; $j++){
                $option = $options[$j];

                if($option["mark"] == 1){
                    $options_html+="<li style=\"color: #209e1c\">"+$option["title"]+"</li>";
                }
                else if($checked_option == $option["id"]){
                    $options_html+="<li style=\"color: red\">"+$option["title"]+"</li>";
                }
                else{
                    $options_html+="<li>"+$option["title"]+"</li>";
                }
            }
            $options_html+="</ol>"
            
        }

        $(".question_section").html($options_html);

        $('.progressbar_modal').modal('hide');
        setTimeout(function() {
            $('.answer_section_modal').modal('show');
        }, 500);
    }

});