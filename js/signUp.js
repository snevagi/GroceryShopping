$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

$('form.sign-up').submit(function(e) {
    e.preventDefault();    
    var formData = $(this).serialize();
    var request = $.ajax({
	     url: "signUp.php",
	     type: "POST",
	     data: formData
    });

    request.done(function(msg) {
	     alert(msg);
	     window.location.href = "index.php";
    });

    request.fail(function(jqXHR, textStatus) {
	     alert(jqXHR.responseText);
    });
});

$( "#signIn" ).click(function(e) {
      e.preventDefault();
      var email = $('#login input[type=email]').val();
      var passwd = $('#login input[type=password]').val();
      if ($.trim(email).length == 0 || $.trim(passwd).length == 0){
	        alert('All fields are mandatory');
	        return;
      }

    // Function that validates email address through a regular expression.
      function validateEmail(email) {
	         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	         return regex.test(email);
      }

      if(!validateEmail(email)){
	         alert('Email Address is invalid');
	         return;
      }
    
      var myArray = [2];
      var i = 0;   

    $("#login :input").each(function(){
	       if($(this).val() != ""){
	          myArray[i] = ($(this).val());
	          i++;
	       }
    });

    
    var request = $.ajax({
	     url: "signIn.php",
	     type: "POST",
	     data: {email : myArray[0],passwd : myArray[1]},
	     dataType: "html"
    });

    request.done(function(msg) {
	     window.location.href = "index.php";
    });

    request.fail(function(jqXHR, textStatus) {
	     alert(jqXHR.responseText);
    });
        
});


