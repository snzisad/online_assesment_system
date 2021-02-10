$(document).ready(function () {
    var mcq_questions = [];
    var mcq_answers = [];
    var question_position = 0;
    var mcq_quations_interval;
    $(".progress_bar").hide();


    getQuestions();


    $(".btn_next_question").on('click', function(){

        setQuestions(question_position);

        return false;
    });


    function setQuestions($position){

        if($position > 0 && $position<=mcq_questions.length){
            $p = $position-1;

            if(typeof ($("input[name='answer']:checked").val()) === "undefined"){
                mcq_answers.push({
                    "question_id":mcq_questions[$p]["id"],
                    "checked_option_id":-1,
                    "mark":0,
                });
            }
            else{
                var selected_question = mcq_questions[$p];
                var selected_option = selected_question["options"];
                var selected_position = $("input[name='answer']:checked").val();

                mcq_answers.push({
                    "question_id":selected_question["id"],
                    "checked_option_id":selected_option[selected_position]["id"],
                    "mark":selected_option[selected_position]["mark"],
                });
            }

        }



        if($position<mcq_questions.length){
            setQuestionInformation($position);
        }
        else{
            var token = $("[name='_token']").val();
            $(".progress_bar").show();
            $(".btn_next_question").attr("disabled", true);
            clearInterval(mcq_quations_interval);

            $.ajax({
                type: "POST",
                url: "/set_mcq_answers",
                data: {
                    "_token": token,
                    "mcq_answers": mcq_answers
                },
                success: function(response){
                    $(".progress_bar").hide();
                    $(".btn_next_question").attr("disabled", false);

                    // var response = jQuery.parseJSON(response);

                    if(response.status){
                        mcq_questions = response.data;

                        var urlPath = "/situation_question";
                        parent.location = urlPath;
                    }

                },
                error: function(error){
                    console.log("Error: "+error);
                }
            });
        }

        question_position++;

    }


    function setQuestionInformation($position){
        clearInterval(mcq_quations_interval);
        setQuestionInterval();
        $( "*" ).removeClass("selected_question_number" );
        var selected_question_number = $(".question_number").find(".p-2")[$position];
        selected_question_number.className = "p-2 selected_question_number";

        $('.question_no').text(($position+1)+"/"+mcq_questions.length);
        $('.question_label').text(($position+1)+". "+mcq_questions[$position]["title"]);

        $options_html = "";

        var options = mcq_questions[$position]["options"];

        for($i=0; $i<options.length; $i++){
            var option = options[$i];
            $options_html+="<div class=\"d-flex\"><input type=\"radio\" class=\"p-2 align-self-start\" name=\"answer\" id=\"option_"+$i+"\" value=\""+$i+"\"> <label class=\"p-2 align-self-start\" for=\"option_"+$i+"\">"+option["title"]+"</label></div>";

        }

        $(".question_option").html($options_html);
        $(".question_content").show();

        // setQuestionInterval();
    }

    function getQuestions(){
        $(".question_content").hide();
        $(".progressbar_content").show();
        var token = $("[name='_token']").val();

        $.ajax({
            type: "POST",
            url: "/get_mcq_questions",
            data: {
                "_token": token
            },
            success: function(response){
                // var response = jQuery.parseJSON(response);

                console.log(response);

                if(response.status){
                    mcq_questions = response.data;
                    setQuestions(0);
                    $(".progressbar_content").hide();
                }

            },
            error: function(error){
                console.log("Error: "+error);
            }
        });
    }

    function setQuestionInterval(){
        var mcq_quations_interval_time = 30;

        mcq_quations_interval = setInterval(function(){
            mcq_quations_interval_time = mcq_quations_interval_time-1;
            $('.mcq_question_timer').text(mcq_quations_interval_time+" Seconds");
            if(mcq_quations_interval_time<=10){
                $('.mcq_question_timer').css('color', 'red');
            }
            else{
                $('.mcq_question_timer').css('color', 'green');
            }

            if(mcq_quations_interval_time<=0){
                clearInterval(mcq_quations_interval);
                setQuestions(question_position);
            }
        }, 1000);

    }

});
