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

});

