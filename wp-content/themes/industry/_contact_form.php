<h2>Leave a Comment</h2>
<div id="notification">
    <span class="notification-message"></span>
</div>
<form id="contact-form">
    <div class="form-group">
        <input id="name" name="form[name]" type="text" class="form-control required" placeholder="Full name">
    </div>
    <div class="form-group">
        <input id="email" name="form[email]" type="email" class="form-control required email"  placeholder="Email Address">
    </div>
    <textarea id="message" name="form[message]" class="form-control required" placeholder="Enter your message here.."></textarea>
    <input type="submit" class="btn btn-default" value="Send Message">
    <button id="clear_form" type="button" class="btn btn-default">Clear Fields</button>
</form>


<script>
    jQuery(document).ready(function($){
        function clearForm(){
           jQuery('#name').val(''); 
           jQuery('#email').val(''); 
           jQuery('#message').val(''); 
        }
        
        jQuery( "#contact-form" ).submit(function(event) {
            event.preventDefault();
        
            var formData = {
                'name'      : jQuery('input[id=name]').val(),
                'email'     : jQuery('input[id=email]').val(),
                'message'   : jQuery('textarea[id=message]').val()
            };
            
            var data = {
                'action': 'contact_log',
                'log'   : formData
            };
            
            jQuery.post('/wp-admin/admin-ajax.php', data, function(response){
                console.log(response);
                jQuery('#notification').attr('id', 'success-notification');
                jQuery('#success-notification span').html("Thanks for your message! We'll get back to you shortly.");
                jQuery('#success-notification').show('fast');
                clearForm();
            });
        });
        jQuery("#clear_form").click(function(){
            clearForm();
        });
    });
</script>
   