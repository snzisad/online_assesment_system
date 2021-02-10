$(document).ready(function () {

    $(".btn-reset-pass").on('click', function(){

        var parent = $(this).parent().parent().parent();
        $("#employee_id2").val(parent.children(".employer_id").html());
        $(".rest_employer_name").html(parent.children(".employer_name").html());

        return true;
    });

    $(".btn-edit-info").on('click', function(){

        var parent = $(this).parent().parent().parent();
        
        $("#employee_id").val(parent.children(".employer_id").html());
        $("#employer_name").val(parent.children(".employer_name").html());
        $("#employer_designation").val(parent.children(".employer_designation").html());
        $("#employer_doj").val(parent.children(".employer_doj").html());

        return true;
    });

});