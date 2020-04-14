$(document).ready(function(){
    var siteurl = 'http://localhost/EMR/';
    // delete confirmation sweet alert
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    // get all doctors list according to clinic
    $('#clinics').change(function() {
    	var clinicID = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            url: siteurl + 'patient/getDoctors',
            data: { clinicID : clinicID } 
        }).done(function(response){
        	var html = response.doctors;
        	$("#doctors").html(html);
        });
    });

    // Validate patient add form
    $("#createpatient").validate({
	    rules: {
	        patient_clinic_id: {
	            required: true,
	        },
	        patient_doctor_id: {
	            required: true,
	        },
	        name: {
	        	required:true
	        },
	        email: {
	        	required: true,
	        	email: true
	        },
	        mobile: {
	        	required:true,
	        	number:true,
	        	maxLength:10,
	        	minLenth:10
	        },
	        state: {
	        	required:true
	        },
	        country: {
	        	required:true
	        },
	        address: {
	        	required:true
	        },
	        occupation: {
	        	required:true
	        },
	        status: {
	        	required:true
	        },
	        image: {
	            extension: "jpg|png|jpeg|bmp"
	        }
	    },
	    messages: {
	    	patient_clinic_id: {
	            required: "Please select one clinic.",
	        },
	        patient_doctor_id: {
	            required: "Please select one doctor.",
	        },
	        name: {
	        	required: "Please enter your name."
	        },
	        email: {
	        	required: "Please enter your email address.",
	        	email: "Please enter valid email address"
	        },
	        mobile: {
	        	required:"Please enter your mobile number.",
	        	number:"Please enter your numeric digits.",
	        	max:"Mobile length should not be greater than 10 digits",
	        	max:"Mobile length should not be less than 10 digits"

	        },
	        state: {
	        	required: "Please enter your state.",
	        },
	        country: {
	        	required: "Please enter your country.",
	        },
	        address: {
	        	required: "Please enter your address.",
	        },
	        occupation: {
	        	required: "Please enter your occupation.",
	        },
	        status: {
	        	required: "Please enter your status.",
	        },
	        image: {
	            extension: "Only jpg|png|jpeg|bmp extensions are allowed to upload"
	        }
	    },
		submitHandler: function(form) {
		    form.submit();
		}
	});


    // Clinic validation
    $("#createclinic").validate({
	    rules: {
	        clinic_name: {
	            required: true,
	        },
	        clinic_type: {
	            required: true,
	        },
	        clinic_place: {
	        	required:true
	        },
	        clinic_description: {
	        	required: true
	        },
	        clinic_address: {
	        	required:true
	        }
	    },
	    messages: {
	    	clinic_name: {
	            required: "Please enter your clinic name."
	        },
	        clinic_type: {
	            required: "Please enter your clinic type."
	        },
	        clinic_place: {
	        	required: "Please enter your clinic place."
	        },
	        clinic_description: {
	        	required: "Please enter your clinic description."
	        },
	        clinic_address: {
	        	required: "Please enter your clinic address."
	        }
	    },
		submitHandler: function(form) {
		    form.submit();
		}
	});

	// Doctor create validation
    $("#createclinic").validate({
	    rules: {
	        doctor_clinic_id: {
	            required: true,
	        },
	        doctor_name: {
	            required: true,
	        },
	        doctor_fees: {
	        	required:true
	        },
	        doctor_speciality: {
	        	required: true
	        },
	        doctor_address: {
	        	required:true
	        },
	        doctor_phone: {
	        	required:true
	        }
	    },
	    messages: {
	    	doctor_clinic_id: {
	            required: "Please select your cinic."
	        },
	        doctor_name: {
	            required: "Please enter your doctor name."
	        },
	        doctor_fees: {
	        	required: "Please enter your doctor fees."
	        },
	        doctor_speciality: {
	        	required: "Please enter doctor speciality."
	        },
	        doctor_address: {
	        	required: "Please enter address of doctor clinic."
	        },
	        doctor_phone: {
	        	required: "Please enter doctor mobile number."
	        }
	    },
		submitHandler: function(form) {
		    form.submit();
		}
	});
});

