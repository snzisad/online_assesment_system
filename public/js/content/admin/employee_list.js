$(document).ready(function () {

    $(".btn-edit-info").on('click', function(){

        var parent = $(this).parent().parent().parent();
        
        $("#employee_id").val(parent.children(".employee_id").html());
        $("#employee_name").val(parent.children(".employee_name").html());
        $("#employee_designation").val(parent.children(".employee_designation").html());
        $("#employee_doj").val(parent.children(".employee_doj").html());

        return true;
    });

});