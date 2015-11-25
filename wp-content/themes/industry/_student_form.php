<?php
$studentID = $_GET['edit'];

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
    <div class="col-xs-12 col-lg-6"><?php
    if($_GET['edit']): ?>
        <form class="update-student-form">
        <input type="hidden" id="user_id" name="form[user_id]" value="<?php echo $_GET['edit'] ?>"/><?php
    endif;?>
        <form class="enrolment-form">
            <div class="form-group">
                <label for="first_name" class="sr-only">First Name</label>
                <input id="first_name" class="form-control required" type="text" name="form[first_name]" placeholder="First Name *" value="<?php echo get_user_meta($studentID, 'first_name', true) ?>"/>
            </div>
            <div class="form-group">
                <label for="last_name" class="sr-only">Last Name</label>
                <input id="last_name" class="form-control required" type="text" name="form[last_name]" placeholder="Last Name *" value="<?php echo get_user_meta($studentID, 'last_name', true)?>"/>
            </div>
            <div class="form-group">
                <label for="user_email" class="sr-only">Email Address</label><?php
                if($_GET['edit']): ?>
                <input id="user_email" disabled class="form-control" type="text" name="form[user_email]" placeholder="Email Address *" value="<?php echo get_user_meta($studentID, 'nickname', true)?>"/><?php
                else: ?>
                <input id="user_email" class="form-control required email" type="text" name="form[user_email]" placeholder="Email Address *" value="<?php echo get_user_meta($studentID, 'nickname', true)?>"/><?php
                endif; ?>
            </div>
            <label for="classroom">Enroll to Classroom</label>
            <div class="form-group select-style">
                <select id="classroom" class="form-control" name="form[classroom]">
                    <option value="default">Assign to Classroom</option><?php
                    foreach($classrooms as $classroom):?>
                        <option value="<?php echo $classroom['class_name']?>"<?php if($classroom['class_name'] == get_user_meta($studentID, 'classroom', true) ) echo 'selected'; ?>> <?php echo $classroom['class_name'] ?></option><?php
                    endforeach;     
                ?></select>
            </div>
            <div class="form-group" id="profile-image-container">
                <input type="button" class="btn btn-default secondary-button select-image" value="Set Profile Picture"/>
                <div id="image-container" class="photo"><?php
                    $photo = (get_user_meta($studentID, 'profile_image', true)) ?
                            get_user_meta($studentID, 'profile_image', true) : array();
                    if($photo != 'none' && $photo) : ?>
                        <li>
                            <input type="hidden" name="form[profile_image]" value="<?php echo $photo ?>"/>
                            <img src="<?php echo $photo ?>" width="170" height="170"/>
                            <div>
                                <button type="button" class="delete btn btn-danger">Delete</button>
                            </div>
                        </li><?php
                    endif;?>
                </div>
            </div><?php
            if($_GET['edit']): ?>
            <input class="btn btn-default" type="submit" value="Update Student"/><?php
            else: ?>
            <input class="btn btn-default" type="submit" value="Create Student"/><?php
            endif; ?>
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