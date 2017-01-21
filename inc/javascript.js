// jQuery plugin to prevent double submission of forms
jQuery.fn.preventDoubleSubmission = function () {
    $(this).on('submit', function (e) {
        var form = $(this);
        if (form.data('submitted') === true) {
            // Previously submitted - don't submit again
            e.preventDefault();
        } else {
            form.data('submitted', true);
        }
    });

    // Keep chainability
    return this;
};

$(document).ready(function() {
    $('#form_submit').click(function(){
	    $('#form_submit').toggle();
	    $('#loader').toggle();
	});

    $('form').preventDoubleSubmission();
 });


