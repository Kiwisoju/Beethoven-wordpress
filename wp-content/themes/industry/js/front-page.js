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

// jQuery(function($){
//     jQuery( "#login-form" ).submit(function(event) {
//             event.preventDefault();
//             // var formData = {
//             //     'username'      : jQuery('input[id=username]').val(),
//             //     'password'     : jQuery('input[id=password]').val()
//             // };
            
//             // var data = {
//             //     'action': 'login',
//             //     'login'   : formData
//             // };
//             jQuery.ajax({
//                 type: 'POST',
//                 dataType: 'json',
//                 url: '/wp-admin/admin-ajax.php',
//                 data: { 
//                     'action': 'login', //calls wp_ajax_nopriv_ajaxlogin
//                     'username': jQuery('input[id=username]').val(), 
//                     'password': jQuery('input[id=password]').val(),
//                     success: function(data){
//                         console.log('this should be the message from the other file..');
//                         console.log(data);
//                         // if (data.loggedin == true){
//                         //     document.location.href = ajax_login_object.redirecturl;
//                         // }
//                     }
//                 }
//             });
            
            
            
            
//             // jQuery.post('/wp-admin/admin-ajax.php', data, function(response){
//             //     console.log(response);
//             //     var redirect = '';
                
//             //     // If there is a notification display it
//             //     if(response[0].notification){
//             //         //Display the notification somewhhere
//             //         console.log(response[0].notification);
//             //     }else{
//             //         //Redirect the user to the correct url, ie. they have logged in
//             //         switch(response[0].meta_value) {
//             //             case '10': 
//             //                 redirect = '/wp-admin';
//             //                 break;
//             //             case '5':
//             //                 redirect = '/teacher.php';
//             //                 break;
//             //             case '4':
//             //                 redirect = '/student.php';
//             //                 break;
//             //         }
//             //         window.location.href = document.location.origin + redirect;
//             //     }
//             // },'json');
//     });
// });