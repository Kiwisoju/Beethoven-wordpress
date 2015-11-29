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
    
    $(document).ready(function(){
        // Setting up plyr controls
        (function(d, p){
            var a = new XMLHttpRequest(),
                b = d.body;
            a.open("GET", p, true);
            a.send();
            a.onload = function(){
                var c = d.createElement("div");
                c.style.display = "none";
                c.innerHTML = a.responseText;
                b.insertBefore(c, b.childNodes[0]);
            }
        })(document, "wp-content/themes/industry/images/svg/sprite.svg");
        
        glennsFormValidator.init();
   
   
       $('#contact-submit').attr('disabled', true);
       
       $('.required').on('blur', function(){
          // Checking if there is an error class
          console.log($('.error').length);
          if($('.validated').length === $('.required').length){
             // Enabling the submit button.
             console.log('enable button');
             $('input[type=submit]').attr('disabled', false);
          }else{
             $('input[type=submit]').attr('disabled', true);
          }
       }); 
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

jQuery(function($){
    $(document).on('ready', function(){
       plyr.setup();        
    });
});
