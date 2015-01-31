$(function () {


$("#upload-image, #upload-background").on('submit', function(e){
		e.preventDefault();
	});

    $('#fileupload').fileupload({

    	dataType: 'json',
        add: function (e, data) {
			var uploadErrors = [];
			var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
			if(!acceptFileTypes.test(data.originalFiles[0]['type'])) {
			  uploadErrors.push('This is not an image!');
			}
			if(data.originalFiles[0]['size'] > 2000000) {
			  uploadErrors.push('The file is too big (max 2MB)!');
			}
			if(uploadErrors.length > 0) {
				$("#logo-upload-message").html( '<span class="error">' + uploadErrors.join("<br/>") + '</span>' );
			    return;
			}

        	$("#logo-upload-filename").html(data.originalFiles[0].name);
        	$("#logo-upload-button").removeClass('disabled').on('click', function (e) {
        		e.preventDefault();
        		$("#logo-preview").html($("<img>").attr('src', 'loading.gif'));
	            data.submit();
	        });
        },

        progressall: function (e, data) {
        	$("#logo-upload-message").html('Uploading...');
	        var progress = parseInt(data.loaded / data.total * 100, 10);
	        $('#logo-progress .bar').css(
	            'width',
	            progress + '%'
	        );
	    },

        done: function (e, data) {
    		$("#logo-upload-message").html(data.result.message);
            $("#logo-preview img").css({opacity: 1});
    		if(data.result.status == 'success') {
    		$("#logo-preview").html($("<img>").attr('src', data.result.image[0]));
    		$("#logo-delete").show();
    	} else {
    		$("#logo-delete").hide();
    	}
    },
       
     });


    $('#fileupload-background').fileupload({
        dataType: 'json',
        // forceIframeTransport: true,


        add: function (e, data) {

			var uploadErrors = [];
			var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
			if(!acceptFileTypes.test(data.originalFiles[0]['type'])) {
				uploadErrors.push('This is not an image!');
			}
			if(data.originalFiles[0]['size'] > 2000000) {
				uploadErrors.push('The file is too big (max 2MB)!');
			}
			if(uploadErrors.length > 0) {
				$("#background-upload-message").html( '<span class="error">' + uploadErrors.join("<br/>") + '</span>' );
				return;
			}

        	$("#background-upload-filename").html(data.originalFiles[0].name);
        	$("#background-upload-button").removeClass('disabled').on('click', function (e) {
        		e.preventDefault();
        		$("#background-preview").html($("<img>").attr('src', 'loading_drk.gif'));
	            data.submit();
	        });
        },
        progressall: function (e, data) {
        	$("#background-upload-message").html('Uploading...');

	        var progress = parseInt(data.loaded / data.total * 100, 10);
	        $('#background-progress .bar').css(
	            'width',
	            progress + '%'
	        );
	    },
        done: function (e, data) {
        	
        	
        	
    		$("#background-upload-message").html(data.result.message);
    		$("#background-preview img").css({opacity: 1});
    		if(data.result.status == 'success') {
    			
    			$("#background-preview").html($("<img>").attr('src', data.result.image[0]));
    			$("#background-delete").show();
    			$('#finished-editing').html("<a href='/dash'><button class='b-blue c-white' id='custom-button'>Check out Your About Us Page!</button></a>");
    		} else {
    			
    			$("#background-delete").hide();
    		}
        }
    });

	$("#background-delete").on('click', function(e){
		e.preventDefault();
		$("#background-preview").html($("<img>").attr('src', 'loading_drk.gif'));
		$("#background-upload-message").html('Deleting...');
		$.ajax({
			url: $(this).attr('data-url'),
			success: function(data) {
				$("#background-preview").html('');
				if(data.status == 'success') {
					$("#background-upload-message").html('Background removed.');
					$("#background-delete").hide();
				} else {
					$("#background-upload-message").html('An error occurred, please reload the page.');
				}
			}
		});
	});

	$("#logo-delete").on('click', function(e){
		e.preventDefault();
		$("#logo-preview").html($("<img>").attr('src', 'loading_drk.gif'));
		$("#logo-upload-message").html('Deleting...');
		$.ajax({
			url: $(this).attr('data-url'),
			success: function(data) {
				$("#logo-preview").html('');
				if(data.status == 'success') {
					$("#logo-upload-message").html('Logo removed.');
					$("#logo-delete").hide();
				} else {
					$("#logo-upload-message").html('An error occurred, please reload the page.');
				}
			}
		});
	});
	});



