function initMenu() {
    jQuery('#menu ul').hide();
    jQuery('#menu ul').children('.current').parent().show();
    //jQuery('#menu ul:first').show();
    jQuery('#menu li a').click(function(){
        console.log('clicked menu item');
        var checkElement = jQuery(this).next();
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            return false;
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            jQuery('#menu ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            return false;
        }
    });
}

jQuery(document).ready(function(){
    initMenu();
    jQuery("#menu-toggle").click(function(e) {
        e.preventDefault();
        console.log('menu toggle 1 clicked');
        jQuery("#wrapper").toggleClass("toggled");
    });
});



// Looking at processing all forms to one ajax endpoint, and within this app variable
// will be setting up different cases depending on the type of request and handling them
// accordingly.

var app = (function($){
    // Define your processor object
    var ajax_data = {
          url: '/wp-admin/admin-ajax.php',
          dataType: 'json',
          success: function(response){console.log(response)},
          error: function(err){ console.log(err); },
          method: 'POST',
          data: { 
                action : 'processor',
                formData : {}
          }
    };
    
    function form_processor(form_name){
        var data = {};
        $('input[type="text"], option:selected, input:checked, textarea', $(form_name) ).each(function(i, el){
            var value = $(el).val();
            
            // If element is an option
            if($(el).is('option')){
                // Grab the name from the select's name
                var name = $(el).closest('select').attr('name').replace('form[','') .replace(']','');
            }else{
                var name = $(el).attr('name').replace('form[','') .replace(']','');
            }
            
            // Get and store value
            data[name] = value;
        });
        return data;
    };

    var processor = {
             enrolment: function(e){
                // Prevent default submission
                e.preventDefault();
                // Copy the ajax_data
                var enrolment_data = ajax_data;
                // Define the processor specific data
                enrolment_data.data.formData = form_processor('.enrolment-form');
                enrolment_data.data.formData['type'] = 'enrolment';
                console.log(enrolment_data);
                // Process the data
                $.ajax(enrolment_data);
              }
        };
    
    // Bind your processor object to form submit events, etc..
    $(document).on('submit','.enrolment-form', processor.enrolment);

    return { 
      processor: processor,
      other: 'other stuff'
    };
})(jQuery);

