jQuery(function($){
    $(document).on('change', function(){
        switch($('option:selected').val()) {
        case 'analytics':
            $('#video-title').html('Using Analytics');
            $('#video-blurb').html('Explanation on the video and using analytics.');
            break;
        case 'lesson':
            $('#video-title').html('Creating a Lesson');
            $('#video-blurb').html('Explanation on the video and creating lessons.');
            break;
        case 'classroom':
            $('#video-title').html('Creating a Classroom');
            $('#video-blurb').html('Explanation on the video and creating a classroom.');
            break;
        case 'ear-trainer':
            $('#video-title').html('Exploring the Ear Trainer');
            $('#video-blurb').html('Explanation on the video and using the ear trainer');
            break;
        }    
    });
});

jQuery(function($) {
  // Setup drop down menu
  $('.dropdown-toggle').dropdown();
 
  // Fix input element click problem
  $('.dropdown input, .dropdown label').click(function(e) {
    e.stopPropagation();
  });
});

//Prevent the login form from submitting default and send data to ajax processor.

jQuery(function($){
    jQuery( "#login-form" ).submit(function(event) {
            event.preventDefault();
            
            var formData = {
                'username'      : jQuery('input[id=username]').val(),
                'password'     : jQuery('input[id=password]').val()
            };
            
            //console.log(formData);
            
            var data = {
                'action': 'login',
                'login'   : formData
            };
            
            jQuery.post('/wp-admin/admin-ajax.php', data, function(response){
                console.log(response);
                if(response == 'true'){
                    //redirect to student page
                    window.location.href = document.location.origin + '/somepage.html';
                }else{
                    //display notifcation on errorsros.
                }
            });
    });
});