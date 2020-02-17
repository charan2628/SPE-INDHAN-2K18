$(document).ready(function() {
	$('form').validate({
  rules: {
    firstName: {
      minlength: 2,
      required: true
    },
    lastName: {
      minlength: 2,
      required: true
    },
    email: {
      required: true,
      email: true
    },
    phone: {
     minlength:10, 
     maxlength:10
    },
    password: {
      minlength: 6,
      required: true
    },
    passwordconf: {
      equalTo: "#password"
    }
      },
  success: function(label) {
    label.text('OK!').addClass('valid');
  }
});
});