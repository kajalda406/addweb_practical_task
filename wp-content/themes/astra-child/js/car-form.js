jQuery(document).ready(function($) {
    $('#ajax-contact-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        var name = $("#name").val();
        var make = $("#make").val();
        var model = $("#model").val();
        var fuelType = $("input[name='fuel_type']:checked").val();

        $.ajax({
            type: 'POST',
            url: carEntry.ajaxurl,
            data: {
                action: 'contact_form',
                name: name,
                make : make,
                model: model,
                fuel_type: fuelType
                
            },
            success: function(data) {
                $('#response-message').text(data); // Display the response
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);
            }
        });
    });
});
