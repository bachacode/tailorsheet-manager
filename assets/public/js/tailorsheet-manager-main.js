(function( $ ) {
    $( window ).load(function() {
        $("#searchbarSubmit i").hide();
        $("#categorySubmit i").hide();

        function disableAll() {
            $('#searchbarSubmit').prop('disabled', true);
            $('#categorySubmit').prop('disabled', true);
            $('#categoryReset').prop('disabled', true);
            $('#searchbarSubmit span').hide();
            $('#searchbarSubmit i').show();
            $('#categorySubmit span').hide();
            $('#categorySubmit i').show();
            $('#appsheetFunctionsList').toggleClass('appsheet-functions-list__overlay');
        }

        function enableAll() {
            $('#searchbarSubmit').prop('disabled', false);
            $('#categorySubmit').prop('disabled', false);
            $('#categoryReset').prop('disabled', false);
            $('#searchbarSubmit span').show();
            $('#searchbarSubmit i').hide();
            $('#categorySubmit span').show();
            $('#categorySubmit i').hide();
            $('#appsheetFunctionsList').toggleClass('appsheet-functions-list__overlay');
        }

        $('#searchbarForm').on('submit', function(e){
            e.preventDefault();
    
            const form = document.getElementById('searchbarForm');
            const afContainer = $('#appsheetFunctionsList');

            const formData = new FormData( form );
            formData.append( 'action', 'prefix_query_tailorsheet_manager' );
            formData.append( '_wpnonce', wp_ajax._nonce );
       
            $.ajax({
                cache: false,
                type: "POST",
                url: wp_ajax.admin_ajax_url,
                data: formData,
                processData: false, // Required for file upload
                contentType: false, // Required for file upload
                beforeSend: function () {
                    disableAll();
                },
                success: function( response ){
                    afContainer.innerHTML = '';
                    afContainer.html(response);
                },
                error: function( xhr, status, error ) {
                    // console.log( 'Status: ' + xhr.status );
                    // console.log( 'Error: ' + xhr.responseText );
                },
                complete: function() {
                    enableAll();
                }
            });
        });

        $('#categoryForm').on('submit', function(e){
            e.preventDefault();
    
            const form = document.getElementById('categoryForm');
            const afContainer = $('#appsheetFunctionsList');

            const formData = new FormData( form );
            formData.append( 'action', 'prefix_query_tailorsheet_manager_by_category' );
            formData.append( '_wpnonce', wp_ajax._nonce );
       
            $.ajax({
                cache: false,
                type: "POST",
                url: wp_ajax.admin_ajax_url,
                data: formData,
                processData: false, // Required for file upload
                contentType: false, // Required for file upload
                beforeSend: function () {
                    disableAll();
                },
                success: function( response ){
                    afContainer.innerHTML = '';
                    afContainer.html(response);
                },
                error: function( xhr, status, error ) {
                    // console.log( 'Status: ' + xhr.status );
                    // console.log( 'Error: ' + xhr.responseText );
                },
                complete: function() {
                    enableAll();
                }
            });
        });

        $('#categoryReset').on('click', function(e){
            e.preventDefault();
            $('#categoryForm').trigger('reset');
            const form = document.getElementById('categoryForm');
            const afContainer = $('#appsheetFunctionsList');

            const formData = new FormData( form );
            formData.append( 'action', 'prefix_query_tailorsheet_manager_by_category' );
            formData.append( '_wpnonce', wp_ajax._nonce );
       
            $.ajax({
                cache: false,
                type: "POST",
                url: wp_ajax.admin_ajax_url,
                data: formData,
                processData: false, // Required for file upload
                contentType: false, // Required for file upload
                beforeSend: function () {
                    disableAll();
                },
                success: function( response ){
                    afContainer.innerHTML = '';
                    afContainer.html(response);
                },
                error: function( xhr, status, error ) {
                    // console.log( 'Status: ' + xhr.status );
                    // console.log( 'Error: ' + xhr.responseText );
                },
                complete: function() {
                    enableAll();
                }
            });
        });
    });
})( jQuery );

