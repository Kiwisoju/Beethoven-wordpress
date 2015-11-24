<?php
$classroomID = $_GET['edit'];
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
        <form class="update-classroom-form">
        <input type="hidden" id="user_id" name="form[user_id]" value="<?php echo $_GET['edit'] ?>"/><?php
    endif;?>
        <form class="enrolment-form">
            <div class="form-group">
                <label for="class_name" class="sr-only">Classroom Name</label>
                <input id="class_name" class="form-control required" type="text" name="form[class_name]" placeholder="Classroom Name *"/>
            </div>
            
            <label for="students">Enroll students into your Classroom</label>
            <div class="form-group select-style">
                <select name="form[students]" id="students" class="form-control"><?php
                    foreach($students as $student): ?>
                        <option value="<?php echo $student['name'] ?>"><?php echo $student['name'] ?></option><?php
                    endforeach; ?>
                </select>
            </div>
            <div class="students row">
                
            </div>
            <input class="btn btn-default" type="submit" value="Create Classroom"/>
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('select').on('change',function(){
           $('.students').append('<div class="student-pill col-lg-4 col-md-4 col-xs-4">' + '<span class="student-name">' + $('option:selected').val() + '</span>' + '<button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="remove">&times;</span></button>' + '<input type="hidden" name="form[student][]" value="' + $('option:selected').val() + '"/>' + '</div>');
        });
    })
    jQuery(document).on('change', function(){
        jQuery('.close').on('click', function(e){
            var element = e.srcElement;
           jQuery(element).closest('.student-pill').remove();
        });
    })
</script>