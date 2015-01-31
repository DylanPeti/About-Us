$(function () {


    $("#upload-image, #upload-background").on('submit', function (e) {
        e.preventDefault();
    });

    $('#fileupload').fileupload({

        add: function (e, data) {


            $("#logo-upload-filename").html(data.originalFiles[0].name);

            $("#logo-upload-button").removeClass('disabled').on('click', function (e) {
                e.preventDefault();
                $("#logo-preview").html($("<img>").attr('src', 'loading_drk.gif'));
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

        done: function (event, data) {

            var results = $.parseJSON(data.result);
            $("#logo-upload-message").html("<p>" + results.message + "</p>");
            var jsons = JSON.stringify(eval(results.image));
            var imageLink = jsons.match(/"([^']+)"/)[1];
            $("#logo-preview").html($("<img>").attr('src', imageLink));


        }

    });

    $('#fileupload-background').fileupload({
        dataType: 'json',
        // forceIframeTransport: true,


        add: function (e, data) {
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
            var results = $.parseJSON(data.result);
            $("#background-upload-message").html("<p>" + results.message + "</p>");
            var jsons = JSON.stringify(eval(results.image));
            var imageLink = jsons.match(/"([^']+)"/)[1];
            $("#background-preview").html($("<img>").attr('src', imageLink));
        }
    });

});

