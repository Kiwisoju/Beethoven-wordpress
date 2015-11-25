<?php
$classroomName = $_GET['edit'];
if($_GET['edit']):?>
    <h2 class="title">Edit classroom</h2>
    <p>Use the form below to edit your classroom.</p><?php

else:?>
    <h2 class="title">Add new classroom</h2>
    <p>Create a brand new classroom and enroll your students.</p><?php
endif;?>

<p>All fields marked with * are required</p>

<div class="notifications">
    <span class="notification-message">
        
    </span>
</div>

<div class="row">
    <div class="col-xs-12 col-lg-6"><?php
    if($_GET['edit']): ?>
        <form class="update" id="classroom-form">
        <input type="hidden" id="old_class_name" name="form[old_class_name]" value="<?php echo $_GET['edit'] ?>"/><?php
    endif;?>
        <form class="create" id="classroom-form">
            <div class="form-group">
                <label for="class_name" class="sr-only">Classroom Name</label>
                <input id="class_name" class="form-control required" type="text" name="form[class_name]" placeholder="Classroom Name *" value="<?php echo $_GET['edit']?>"/>
            </div>
            
            <label for="students">Enroll students into your Classroom</label>
            <div class="form-group select-style">
                <select name="form[students]" id="students" class="form-control"><?php
                    foreach($students as $student): ?>
                        <option value="<?php echo $student['user_id'] ?>"><?php echo $student['name'] ?></option><?php
                    endforeach; 
                ?></select>
            </div>
            <div class="students row"><?php
            if($_GET['edit']):
                foreach($classrooms as $classroom):
                    if($classroom['class_name'] == $_GET['edit']):
                        foreach($classroom['student_id'] as $student):?>
                            <div class="student-pill col-lg-5 col-md-5 col-xs-4">
                                <span class="student-name"><?php 
                                echo get_user_meta($student->user_id, 'first_name', true )
                                 . ' ' . get_user_meta($student->user_id, 'last_name', true )
                             ?></span>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true" class="remove">×</span>
                                </button>
                                <input type="hidden" name="form[student][]" value="<?php echo $student->user_id ?>">
                            </div><?php
                        endforeach;
                    endif;
                endforeach;
            endif;?>
            </div><?php
            if(!$_GET['edit']):?>
                <input class="btn btn-default" type="submit" value="Create Classroom"/><?php
            else:?>
                <input class="btn btn-default" type="submit" value="Update Classroom"/><?php
            endif;?>    
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('select').on('change',function(){
           $('.students').append('<div class="student-pill col-lg-5 col-md-5 col-xs-4">'
                                    + '<span class="student-name">'
                                        + $('option:selected').html() 
                                    + '</span>' 
                                    + '<button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="remove">&times;</span></button>'
                                    + '<input type="hidden" name="form[student][]" value="'+ $('option:selected').val() + '"/>'
                                + '</div>');
        });
    })
    jQuery(document).on('change', function(){
        jQuery('.close').on('click', function(e){
            var element = e.srcElement;
           jQuery(element).closest('.student-pill').remove();
        });
    })
</script>