$(document).ready(function() {

    $('input[type=password]').keyup(function() {
	// keyup code here
	var pswd = $(this).val();
	//validate the length
	if ( pswd.length < 8 ) {
	    $('#length').removeClass('valid').addClass('invalid');
	} else {
	    $('#length').removeClass('invalid').addClass('valid');
	}
	//validate letter
	if ( pswd.match(/[A-z]/) ) {
	    $('#letter').removeClass('invalid').addClass('valid');
	} else {
	    $('#letter').removeClass('valid').addClass('invalid');
	}

	//validate capital letter
	if ( pswd.match(/[A-Z]/) ) {
	    $('#capital').removeClass('invalid').addClass('valid');
	} else {
	    $('#capital').removeClass('valid').addClass('invalid');
	}

	//validate number
	if ( pswd.match(/\d/) ) {
	    $('#number').removeClass('invalid').addClass('valid');
	} else {
	    $('#number').removeClass('valid').addClass('invalid');
	}
	
    }).focus(function() {
	$('#pswd_info').show();
    }).blur(function() {
	$('#pswd_info').hide();
    });

    $('#signUp').click(function(e) {
	var sEmail = $('input[type=email]').val();
	// Checking Empty Fields
	if ($.trim(sEmail).length == 0 || $("#fname").val()=="" || $("#lname").val()=="" || $("#pswd").val()=="") {
	    alert('All fields are mandatory');
	    e.preventDefault();
	}
	if (!validateEmail(sEmail)) {
	    alert('Invalid Email Address');
	    e.preventDefault();
	}
	
	// Function that validates email address through a regular expression.
	function validateEmail(email) {
	    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return regex.test(email);
	}
	
    });
});
