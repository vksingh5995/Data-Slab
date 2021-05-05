var $ = jQuery;

/**
 * Available local variables
 * dataslab.ajax_url        : Ajax url address.
 * dataslab.plugin_version  : Plugin version.
 * dataslab.loading_html    : Loader html template.
 * 
 */

// Alert message template.
var dataslab_alert = `<div class="dataslab-alert {{class}}"><span>{{message}}</span><button>X</button></div>`;

$(document).ready( function() {

    // Ajax query for updating userdata
    $('#dataslab-update-user-form').on('submit', function( e ) {

        // Creating data object for sending in the ajax request
        var data = {
            "action" : "dataslab_update_user"
        };

        // Getting the form data as an array.
        var formData = $(e.currentTarget).serializeArray();

        // Adding form data in the data object. 
        formData.forEach( function( elem ) {
            data[elem.name] = elem.value;
        });

        $('.dataslab-update-container').append( dataslab.loading_html );
        
        // Sending ajax request
        $.post( dataslab.ajax_url, data )
        .done( function( response ){
            var response_alert = dataslab_alert.replace( '{{class}}', response.status ).replace('{{message}}', response.message );
            $('.dataslab-update-container').append( response_alert );

            setTimeout( function() {
                $('.dataslab-alert').remove();
            }, 5000 );
        })
        .fail( function( err ) {
            console.log( err );
        })
        .always( function() {
            $('.dataslab-loading').remove();
        });
    });

    // Alert remove button function
    $(document).on('click', '.dataslab-alert button', function() {
        $('.dataslab-alert').remove();
    });
    
});
