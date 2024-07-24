(function( $ ) {
    $( window ).load(function() {

        $('.appsheet-functions-searchbar__wrapper .search-form').on('submit', function(e){
            e.preventDefault();
    
            const form = document.getElementById('searchbarForm');
      

            const formData = new FormData( form );
            formData.append( 'action', 'prefix_query_appsheet_functions' );
            formData.append( '_wpnonce', wp_ajax._nonce );
       
            $.ajax({
                cache: false,
                type: "POST",
                url: wp_ajax.admin_ajax_url,
                data: formData,
                processData: false, // Required for file upload
                contentType: false, // Required for file upload
                beforeSend: function () {
                    // Add loading class
                },
                success: function( response ){
                    // on success
                    // code...
                },
                error: function( xhr, status, error ) {
                    console.log( 'Status: ' + xhr.status );
                    console.log( 'Error: ' + xhr.responseText );
                },
                complete: function() {
                    // remove loading class
                }
            });
        });
    });
})( jQuery );
