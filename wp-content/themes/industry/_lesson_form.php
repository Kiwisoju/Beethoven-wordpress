<?php
$lessonName = $_GET['edit'];
if($_GET['edit']):?>
    <h2 class="title">Edit Lesson</h2>
    <p>Use the form below to edit your lesson.</p><?php

else:?>
    <h2 class="title">Add new lesson</h2>
    <p>Create a brand new lesson and assign it to your classroom.</p><?php
endif;?>

<p>All fields marked with * are required</p>

<div class="notifications">
    <span class="notification-message">
        
    </span>
</div>

<div class="row">
    <div class="col-xs-12 col-lg-6"><?php
    if($_GET['edit']): ?>
        <form class="update" id="lesson-form">
        <input type="hidden" id="old_class_name" name="form[old_lesson_name]" value="<?php echo $_GET['edit'] ?>"/><?php
    endif;?>
        <form class="create" id="lesson-form">
            <div class="form-group">
                <label for="lesson_name" class="sr-only">Lesson Name</label>
                <input id="lesson_name" class="form-control required" type="text" name="form[lesson_name]" placeholder="Lesson Name *" value="<?php echo $_GET['edit']?>"/>
            </div>
            <label for="exercise_type">Exercise Type</label>
            <div class="form-group select-style">
                <select class="form-control required" id="exercise_type" name="form[exercise_type]">
                    <option value="default" selected disabled>Select an Exercise Type *</option>
                    <option class="type_exercise" value="note_identification">Note Identification</option>
                    <option class="type_exercise" value="interval_recognition">Interval Recognition</option>
                    <option class="type_exercise" value="chord_recognition">Chord Recognition</option>
                </select>
            </div>
            <label for="classroom">Assign Lesson to Classrooms</label>
            <div class="form-group select-style">
                <select name="form[classroom]" id="classroom" class="form-control">
                <option value="default" selected disabled>Select a Classroom *</option><?php
                    foreach($classrooms as $classroom): ?>
                        <option id="classroom_name" value="<?php echo $classroom['class_name'] ?>"><?php echo $classroom['class_name'] ?></option><?php
                    endforeach; 
                ?></select>
            </div>
            <div class="classrooms row">
            </div>
            <div class="exercise row">
                <div class="col-xs-12">
                    <div id="note" class="toggle"><?php
                    include('_note_identification.php');
                  ?></div>
                    <div id="interval" class="toggle"><?php
                    include('_interval_recognition.php');
                  ?></div>
                    <div id="chord" class="toggle"><?php
                    include('_chord_recognition.php');
                  ?></div>
                </div>
                
            </div><?php
            if(!$_GET['edit']):?>
                <input class="btn btn-default" type="submit" value="Create Lesson"/><?php
            else:?>
                <input class="btn btn-default" type="submit" value="Update Lesson"/><?php
            endif;?>    
        </form>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('select[id=classroom]').on('change',function(){
           $('.classrooms').append('<div class="student-pill col-lg-5 col-md-5 col-xs-4">'
                                    + '<span class="classroom-name">'
                                        + $('option[id=classroom_name]:selected').html() 
                                    + '</span>' 
                                    + '<button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="remove">&times;</span></button>'
                                    + '<input type="hidden" name="form[classroom][]" value="'+ $('option:selected').val() + '"/>'
                                + '</div>');
        });
        
        $('select[id=exercise_type]').on('change', function(){
           var exercise = $('option[class=type_exercise]:selected').val();
           console.log(exercise);
           switch(exercise){
               case 'interval_recognition':
                   $('#interval').show();
                   $('#chord').hide();
                   $('#note').hide();
                   break;
               case 'chord_recognition':
                   $('#interval').hide();
                   $('#chord').show();
                   $('#note').hide();
                   break;
               case 'note_identification':
                   $('#interval').hide();
                   $('#chord').hide();
                   $('#note').show();
                   break;
               
           }
        });
    });
    
    jQuery(document).on('change', function(){
        jQuery('.close').on('click', function(e){
            var element = e.srcElement;
           jQuery(element).closest('.student-pill').remove();
        });
    });
    
    
</script>