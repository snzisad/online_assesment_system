$(document).ready(function () {
    var situation_questions = [];
    var question_position = 0;
    var preparation_time_interval;
    var recording_interval;
    var player = null;
    var total_uploaded_video = 0;

    $(".progressbar_content").hide();
    $(".recording_section").hide();
    $(".question_content").hide();
    $(".upload_section").hide();


    initPlayer();
    getQuestions();


    $(".btn_start_recording").on('click', function(){
        startRecording();
        return false;
    });


    $('.btn_stop_recording').on("click", function(){
        stopRecording();
        return false;
    });


    function setQuestions($position){

        if($position<situation_questions.length){
            $(".recording_section").hide();
            $(".progressbar_content").hide();
            $(".question_content").show();

            setQuestionInformation($position);
        }
        else if(situation_questions.length == 0){
            var urlPath = "/thank_you";
            parent.location = urlPath;
        }
        else{
            $(".recording_section").hide();
            $(".progressbar_content").hide();
            $(".question_content").hide();
            $(".upload_section").show();
        }

    }


    function setQuestionInformation($position){
        clearInterval(preparation_time_interval);
        clearInterval(recording_interval);
        setQuestionInterval();

        $( "*" ).removeClass("selected_question_number" );
        var selected_question_number = $(".question_number").find(".p-2")[$position];
        selected_question_number.className = "p-2 selected_question_number";

        $('.question_no').text(($position+1));
        $('.situation_text').text(situation_questions[$position]["title"]);
        $('.role_text').text(situation_questions[$position]["role"]);

        $(".question_content").show();
    }

    function getQuestions(){
        $(".recording_section").hide();
        $(".question_content").hide();
        $(".progressbar_content").show();
        var token = $("[name='_token']").val();

        $.ajax({
            type: "POST",
            url: "/get_assesment_questions",
            data: {
                "_token": token
            },
            success: function(response){
                // var response = jQuery.parseJSON(response);

                if(response.status){
                    situation_questions = response.data;
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
        var preparation_time_interval_time = 60;

        preparation_time_interval = setInterval(function(){
            preparation_time_interval_time = preparation_time_interval_time-1;
            $('.preparation_timer').text(preparation_time_interval_time+" Seconds");

            if(preparation_time_interval_time<=10){
                $('.preparation_timer').css('color', 'red');
            }
            else{
                $('.preparation_timer').css('color', 'green');
            }

            if(preparation_time_interval_time<=0){
                clearInterval(preparation_time_interval);
                startRecording();
            }
        }, 1000);

    }

    function setRecordingTimer(){
        var recording_time = 120;

        recording_interval = setInterval(function(){
            recording_time = recording_time-1;
            $('.record_timer').text(recording_time+" Seconds");

            if(recording_time<=20){
                $('.record_timer').css('color', 'red');
            }
            else{
                $('.record_timer').css('color', 'green');
            }
            if(recording_time<=0){
                clearInterval(recording_interval);
                stopRecording();
                console.log("finish");
            }
        }, 1000);
    }

    function startRecording(){
        $(".progressbar_content").hide();
        $(".recording_section").show();
        $(".question_content").hide();
        clearInterval(preparation_time_interval);
        setRecordingTimer();

        player.record().getDevice();
        var recording_interval = setInterval(function(){
            player.record().start();
            clearInterval(recording_interval);
        }, 1000);
    }

    function stopRecording(){
        player.record().stop();
        clearInterval(recording_interval);

        question_position++;
        setQuestions(question_position);
    }

    function initPlayer(){

        player = videojs("myVideo", {
            controls: false,
            fluid: false,
            width: 300,
            height: 350,
            plugins: {
                record: {
                    audio: true,
                    video: true,
                    debug: false,
                    videoMimeType: 'video/mp4',
                    maxLength: 120,
                },
            },
        }, function(){
            // print version information at startup
            var msg = 'Using video.js ' + videojs.VERSION +
                ' with videojs-record ' + videojs.getPluginVersion('record') +
                ' and recordrtc ' + RecordRTC.version;
            videojs.log(msg);
        });


        // error handling
        player.on('deviceError', function() {
            console.log('device error:', player.deviceErrorCode);
        });

        player.on('error', function(error) {
            console.log('error:', error);
        });

        // user clicked the record button and started recording
        player.on('startRecord', function() {
            console.log('started recording!');
        });

        // user completed recording and stream is available
        player.on('finishRecord', function() {
            // the blob object contains the recorded data that
            // can be downloaded by the user, stored on server etc.
            console.log('finished recording: ', player.recordedData);

            var formData = new FormData();
            var questions_id = situation_questions[question_position-1]["id"];
            console.log("QID - "+questions_id);
            var token = $("[name='_token']").val();
            formData.append('quesion_id', questions_id);
            formData.append('_token', token);

            if(typeof player.recordedData.video != 'undefined'){
                formData.append('video', player.recordedData.video);
            }
            else{
                formData.append('video', player.recordedData);
            }

            $.ajax({
                url: '/upload_video',
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(data){
                    console.log("Success");
                    console.log(data);
                    total_uploaded_video++;
                    console.log("total_uploaded_video: "+total_uploaded_video);
                    console.log("length: "+situation_questions.length);

                    if(total_uploaded_video>=situation_questions.length){
                        var urlPath = "/thank_you";
                        parent.location = urlPath;
                    }
                },
                error: function(data) {
                    console.log("Error");
                    console.log(data);

                    if(question_position>=situation_questions.length){
                        alert("Cannot upload data. Please try again.");
                        var urlPath = "/";
                        parent.location = urlPath;
                    }

                },
            });


        });
    }

});
