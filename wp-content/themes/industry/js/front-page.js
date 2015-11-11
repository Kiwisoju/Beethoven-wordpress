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