<?php
$postID = $_GET[post];

if($_GET['edit']):?>
    <h2 class="title">Edit student</h2>
    <p>Use the form below to edit your student's profile.</p><?php

else:?>
    <h2 class="title">Add new student</h2>
    <p>Create a brand new student and add them to your classroom.</p><?php
endif;?>

<p>All fields marked with * are required</p>

<div class="notifications">
    <span class="notification-message">
        
    </span>
</div>

<div class="row">
    <div class="col-xs-12 col-lg-6">
        <form class="enrolment-form">
            <div class="form-group">
                <label for="first_name" class="sr-only">First Name</label>
                <input id="first_name" class="form-control required" type="text" name="form[first_name]" placeholder="First Name *"/>
            </div>
            <div class="form-group">
                <label for="last_name" class="sr-only">Last Name</label>
                <input id="last_name" class="form-control required" type="text" name="form[last_name]" placeholder="Last Name *"/>
            </div>
            <div class="form-group">
                <label for="user_email" class="sr-only">Email Address</label>
                <input id="user_email" class="form-control required email" type="text" name="form[user_email]" placeholder="Email Address *"/>
            </div>
            <div class="form-group select-style">
                <select id="classroom" class="form-control" name="form[classroom]"><?php
                // Here I need to query from the database to get all of the classes of which the
                // teacher is attached to, and render them into the options values.?>
                    <option value="default">Assign to Classroom</option>
                    <option value="11pt">11pt</option>
                    <option value="9dy">9DY</option>
                </select>
            </div>
            <div class="form-group" id="profile-image-container">
                <input type="button" class="btn btn-default secondary-button select-image" value="Set Profile Picture"/>
                <div id="image-container" class="photo"><?php
                    $photo = (get_post_meta($postID, 'profile_image', true)) ?
                            get_post_meta($postID, 'profile_image', true) : array();
                    if($photo) : ?>
                        <li>
                            <input type="hidden" name="form[profile_image]" value="<?php echo $photo ?>"/>
                            <img src="<?php echo $photo ?>" width="170" height="170"/>
                            <div>
                                <button type="button" class="delete btn btn-danger">Delete</button>
                            </div>
                        </li><?php
                    endif;?>
                </div>
            </div>
            <input class="btn btn-default" type="submit" value="Submit"/>
        </form>
    </div>
</div>
<script type="text/javascript">

    jQuery(function($){
        $('.select-image').click(function(){
            tb_show('', '<?php echo admin_url(); ?>media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        });
        
        $(document).on('click', '.delete', function(){
           $(this).closest('li').remove(); 
        });
        
        // This inserts post calls, we're changing this to insert it to the input, this passes in the html scope
        window.send_to_editor = function(html){
            var pathToImage = $('img',html).attr('src');
            var $li = $('<li>');
            $li.append('<input type="hidden" name="form[profile_image]" value="' + pathToImage + '"/>');
            $li.append('<img src="' + pathToImage + '" width="170" height="170"/>');
            $li.append('<div>');
            $li.append('<button type="button" class="delete btn btn-danger">Delete</button>');
            $li.append('</div>');
            $('.photo').append($li);
            tb_remove();
        }
    });
    
</script>