$(document).ready(function(){

	//banner edit button
	$('.edit_banner_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToImageSlideModal($parent);
		return true;
	});

	//training edit button
	$('.edit_training_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToTrainingModal($parent);
		return true;
	});

	//practice edit button
	$('.edit_practice_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToPracticeModal($parent);
		return true;
	});

	//lawer edit button
	$('.edit_lawer_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToLawerModal($parent);
		return true;
	});

	//client edit button
	$('.edit_client_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToClientModal($parent);
		return true;
	});

	//membership edit button
	$('.edit_membership_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToMembershipModal($parent);
		return true;
	});

	//client edit button
	$('.edit_feedback_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToFeedbackModal($parent);
		return true;
	});

	//client edit button
	$('.edit_link_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToLinkModal($parent);
		return true;
	});

	//paymentmethod edit button
	$('.edit_paymentmethod_button').on("click", function(e){
		$parent = $(this).parent().parent();
		setDataToPaymentmethodModal($parent);
		return true;
	});


	function setDataToImageSlideModal($parent){
		$id = $parent.attr("banner_id");
		$title = $parent.children(".banner_title").text();
		$description = $parent.children(".banner_description").text();

		$("#banner_title").val($title);
		$("#banner_description").text($description);
		$("#banner_id").val($id);
	}	


	function setDataToPracticeModal($parent){
		$id = $parent.attr("practice_id");
		$title = $parent.children(".practice_title").text();
		$description = $parent.children(".practice_description").text();

		$("#practice_title").val($title);
		$("#practice_description").text($description);
		$("#practice_id").val($id);
	}	


	function setDataToLawerModal($parent){
		$id = $parent.attr("lawer_id");
		$name = $parent.children(".lawer_name").text();
		$occupation = $parent.children(".lawer_occupation").text();

		$("#lawer_name").val($name);
		$("#lawer_occupation").val($occupation);
		$("#lawer_id").val($id);
	}	


	function setDataToMembershipModal($parent){
		$id = $parent.attr("membership_id");
		$name = $parent.children(".membership_name").text();

		$("#membership_name").val($name);
		$("#membership_id").val($id);
	}	



	function setDataToClientModal($parent){
		$id = $parent.attr("client_id");
		$name = $parent.children(".client_name").text();

		$("#client_name").val($name);
		$("#client_id").val($id);
	}	


	function setDataToPaymentmethodModal($parent){
		$id = $parent.attr("paymentmethod_id");
		$name = $parent.children(".paymentmethod_name").text();

		$("#paymentmethod_name").val($name);
		$("#paymentmethod_id").val($id);
	}	


	function setDataToLinkModal($parent){
		$id = $parent.attr("link_id");
		$link = $parent.children(".link_title").text();

		$("#link_title").val($link);
		$("#link_id").val($id);
	}	


	function setDataToFeedbackModal($parent){
		$id = $parent.attr("feedback_id");
		$client = $parent.children(".feedback_client").text();
		$occupation = $parent.children(".feedback_client_occupation").text();
		$feedback = $parent.children(".feedback_client_feedback").text();

		$("#feedback_id").val($id);
		$("#feedback_client").val($client);
		$("#feedback_client_occupation").val($occupation);
		$("#feedback_client_feedback").text($feedback);
	}	


	function setDataToTrainingModal($parent){
		$id = $parent.attr("training_id");
		$title = $parent.children(".training_title").text();
		$description = $parent.children(".training_description").text();

		$("#training_id").val($id);
		$("#training_title").val($title);
		$("#training_description").text($description);
	}	


	$(function () {
		$('.edit-notice-button').on('click',function(e){
			var notice=$(this).parent().parent().parent().children("p");
			
			$('#notice-text-textarea').text(notice.text());
			$('#display-field').val("0");
			$('#id-field').val(notice.attr('notice-id'));

			return true;
		})

		$('.edit-current-notice-button').on('click',function(e){
			var notice=$('.current-notice-text').text();
			
			$('#notice-text-textarea').text(notice);
			$('#display').val("1");

			return true;
		})

		$('#catagory-selection').on('change',function(e){
			var value=$(this).val();
			if(value=='add-catagory')
				$('#new-catagory-modal').modal('toggle');
		});

		$('#collect-fee-button').on('click',function(e){
			
		$action=$("#fee-collection-form").attr('action');
		$csrf=$("#token_field").data('token');
		$student_id=$("#student_id").val();
		$catagory=$("#catagory-selection").val();
		$amount=$("#fee_amount").val();

		if(!$student_id){
			alert('Enter Student ID');
			return false;
		}
		else if(!$catagory){
			alert('Select a catagory');
			return false;
		}
		else if(!$amount){
			alert('Enter amount');
			return false;
		}
		
			$('#collect-fee-button').hide();
			$('#loading-spinner').show();
			$('#success-text').hide();
			$('#error-text').hide();


		$.ajax({
			url: $action,
			type: 'POST',
			async: false,
			data: {
			"student_id": $student_id,
			"catagory": $catagory,
			"amount": $amount,
			"_token" : $csrf
			},

			success: function(data){
				data=data.message;

				if(data=='Success'){
				$('#loading-spinner').hide();
				$("#student_id").val('');
					$('#success-text').show().delay(1000).hide(0);
					$('#collect-fee-button').delay(1000).show(0);
				}
				else{
					$('#loading-spinner').hide();
					$('#catagory_error').show();
					$('#error-text').show().delay(1000).hide(0);
					$('#collect-fee-button').delay(1000).show(0)
				}

			},

			error: function(data){
				$('#loading-spinner').hide();
				$('#error-text').show().delay(1000).hide(0);
				$('#collect-fee-button').delay(1000).show(0);
			}
		});

			return false;
		})

	});

	function readLogoURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
		console.log(e.target.result);
			$('#uploaded-logo').attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
	}




});