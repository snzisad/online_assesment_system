$(document).ready(function () {
    var player = null;

    initPlayer();

    function startRecording(){
        
        player.record().getDevice();
        var recording_interval = setInterval(function(){
            player.record().start();
            clearInterval(recording_interval);
        }, 1000);
    }

    function stopRecording(){
        player.record().stop();
    }

    function initPlayer(){

        player = videojs("myVideo", {
            controls: false,
            fluid: false,
            plugins: {
                record: {
                    audio: true,
                    video: true,
                    maxLength: 5,
                    debug: true
                }
            }
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
            console.log('finished recording: ', player.recordedData.name);

            var formData = new FormData();
            var token = $("[name='_token']").val();
            formData.append('video', player.recordedData);
            formData.append('_token', token);

            $.ajax({
                url: '/upload_video',   
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(data){
                    console.log("Success");
                    console.log(data);
                },
                error: function(data) {
                    console.log("Error");
                    console.log(data);
                },
            });

        });
    }

});