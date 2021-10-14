$("#loginform").validate({
	rules: {
		email: {
			required: true
		},
		password: {
			required: true
		}
	},
	messages: {

	},
	errorElement: "span",
		errorPlacement: function(error, element) {
				error.appendTo(element.parent());
		}
});

$("#forgotform").validate({ 
	rules: {
		email_id: {
			required: true,
			email: true
		}
	},
	messages: {

	},
	errorElement: "span",
		errorPlacement: function(error, element) {
				error.appendTo(element.parent());
		}
});


//~ $(document).ready(function() {
	//~ // validate the comment form when it is submitted
	//~ $("#registerform").validate({
		//~ errorElement: "span",
		//~ errorPlacement: function(error, element) {
				//~ error.appendTo(element.parent());
		//~ }
	//~ });
//~ });

$("#registerform").validate({ 
	rules: {
		firstname: {
			required: true
		},
		lastname: {
			required: true
		},
		address: {
			required: true
		},
		phone: {
			required: true,
			number: true
		},
		email: {
			required: true,
			email: true
		},
		password: {
			required: true
		},
		country: {
			required: true
		},
		city: {
			required: true
		}
	},
	messages: {
		 
	},
	errorElement: "span",
		errorPlacement: function(error, element) {
				error.appendTo(element.parent());
		}
});
/*
$('#registerform').bootstrapValidator({
    trigger: 'blur',
    fields: {
        firstname: {
            validators: {
                notEmpty: {
                    message: 'Your first name is required'
                },
                //~ regexp: {
                    //~ regexp: /^[a-zA-Z ]+$/,
                    //~ message: 'Your first name cannot have numbers or symbols'
                //~ }
            }
        },
        lastname: {
            validators: {
                notEmpty: {
                    message: 'Your last name is required'
                },
                //~ regexp: {
                    //~ regexp: /^[a-zA-Z ]+$/,
                    //~ message: 'Your last name cannot have numbers or symbols'
                //~ }
            }
        },
        address: {
            validators: {
                notEmpty: {
                    message: 'Address field is required'
                },
            }
        },
        phone: {
            validators: {
                notEmpty: {
                    message: 'The phone number is required'
                },
                regexp: {
                    regexp: /^\+?1?([()/\.\-\s]*[0-9]){10}\s*((ext|x)\s*[0-9]+)*$/,
                    message: 'Enter vaild phone number'
                }
            }
        }
        email: {
            validators: {
                notEmpty: {
                    message: 'The email is required'
                },
                emailAddress: {
                    message: 'Enter valid email id'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password field is required'
                },
            }
        },
        country: {
            validators: {
                notEmpty: {
                    message: 'Country field is required'
                },
            }
        },
        city: {
            validators: {
                notEmpty: {
                    message: 'City field is required'
                },
            }
        }
    }
})
.on('error.field.bv', '[name="phone"]', function(e, data){
    // change the data-bv-trigger value to keydown
    $(e.target).attr('data-bv-trigger','keydown');
    // destroy the plugin
    // console.info(data.bv.getOptions());
    data.bv.destroy();
    // console.info(data.bv.getOptions());
    // initialize the plugin
    $('#registerform').bootstrapValidator(data.bv.getOptions());
});


//~ $(function() {
  //~ $("form[name='registration']").validate({
    //~ // Specify validation rules
    //~ rules: {
      //~ firstname: "required",
      //~ lastname: "required",
      //~ email: {
        //~ required: true,
        //~ email: true
      //~ },
      //~ password: {
        //~ required: true,
        //~ minlength: 5
      //~ }
    //~ },
    //~ messages: {
      //~ firstname: "Please enter your firstname",
      //~ lastname: "Please enter your lastname",
      //~ password: {
        //~ required: "Please provide a password",
        //~ minlength: "Your password must be at least 5 characters long"
      //~ },
      //~ email: "Please enter a valid email address"
    //~ },
    //~ submitHandler: function(form) {
      //~ form.submit();
    //~ }
  //~ });
//~ });
//~ http://jsfiddle.net/gq5zx661/90/
//~ http://jsfiddle.net/PAjyL/26/
*/
