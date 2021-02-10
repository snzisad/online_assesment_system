$(document).ready(function () {

    $(".btn-edit-info").on('click', function(){

        var parent = $(this).parent().parent();
        
        $("#question_id").val($(this).attr("content"));
        $("#question_case").val(parent.children(".question_case").html());
        $("#question_role").val(parent.children(".question_role").html());

        return true;
    });

});