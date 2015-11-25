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
                <select id="classroom" class="form-control">
                <option value="default" selected disabled>Select a Classroom *</option><?php
                    foreach($classrooms as $classroom): ?>
                        <option id="classroom_name" value="<?php echo $classroom['class_name'] ?>"><?php echo $classroom['class_name'] ?></option><?php
                    endforeach; 
                ?></select>
            </div>
            <div class="classrooms row">
            </div>
            <div class="exercise row">
                <div class="col-xs-12" id="exercise-container">
                    <div id="note" class="toggle">
                        <span class="exercise-title">Note Identification</span><?php
                        include('_note_identification.php');
                  ?><button type="button" id="note-button" class="btn btn-default secondary-button exercise-button">Add Question</button>    
                    </div>
                    <div id="interval" class="toggle">
                        <span class="exercise-title">Interval Recognition</span><?php
                        include('_interval_recognition.php');
                    ?><button type="button" id="interval-button" class="btn btn-default secondary-button exercise-button">Add Question</button>
                    </div>
                    <div id="chord" class="toggle">
                        <span class="exercise-title">Chord Recognition</span><?php
                        include('_chord_recognition.php');
                  ?><button type="button" id="chord-button" class="btn btn-default secondary-button exercise-button">Add Question</button>
                  </div>
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
           $('.classrooms').append('<div class="student-pill toggle-remove col-lg-5 col-md-5 col-xs-4">'
                                    + '<span class="classroom-name">'
                                        + $('option[id=classroom_name]:selected').html() 
                                    + '</span>' 
                                    + '<button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="remove">&times;</span></button>'
                                    + '<input type="hidden" name="form[classroom][]" value="'+ $('option[id=classroom_name]:selected').val() + '"/>'
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
    
    jQuery(document).on('click', function(){
       jQuery('.close').on('click', function(e){
            var element = e.srcElement;
            jQuery(this).closest('.toggle-remove').remove();
        });
        
        
    });
    
    jQuery(document).on('ready', function(){
        jQuery('#interval-button').on('click', function(e){
            e.preventDefault();
            // Need to get the count of .question-containers to get the next Q number.
            var questionNumber = jQuery('.question-container').length + 1;
            jQuery(e.currentTarget).before('<div class="question-container toggle-remove">\
                                    <div class="question-number">\
                                        <span>Q.' + questionNumber + '</span>\
                                    </div>\
                                    <label for="" class="exercise-label">Choose Starting Note</label>\
                                    <div class="form-group select-style exercise-select">\
                                        <select name="form[question][]" class="question form-control">\
                                            <option value="default" selected disabled>Choose Starting Note</option>\
                                            <option value="a">A</option>\
                                            <option value="a_sharp">A#</option>\
                                            <option value="b">B</option>\
                                            <option value="c">C</option>\
                                            <option value="c_sharp">C#</option>\
                                            <option value="d">D</option>\
                                            <option value="d_sharp">D#</option>\
                                            <option value="e">E</option>\
                                            <option value="f">F</option>\
                                            <option value="f_sharp">F#</option>\
                                            <option value="g">G</option>\
                                            <option value="g_sharp">G#</option>\
                                        </select>\
                                    </div>\
                                    <label for="" class="exercise-label">Choose Interval</label>\
                                    <div class="form-group select-style exercise-select">\
                                        <select name="form[answer][]" class="answer form-control">\
                                            <option value="default" selected disabled>Choose Interval</option>\
                                            <option value="min_2">Minor 2nd</option>\
                                            <option value="maj_2">Major 2nd</option>\
                                            <option value="min_3">Minor 3rd</option>\
                                            <option value="maj_3">Major 3rd</option>\
                                            <option value="per_4">Perfect 4th</option>\
                                            <option value="aug_4">Tritone</option>\
                                            <option value="per_5">Perfect 5th</option>\
                                            <option value="min_6">Minor 6th</option>\
                                            <option value="maj_6">Major 6th</option>\
                                            <option value="min_7">Minor 7th</option>\
                                            <option value="maj_7">Major 7th</option>\
                                            <option value="oct">Octave</option>\
                                        </select>\
                                    </div>\
                                        <button type="button" class="close exercise-close" aria-label="Close">\
                                            <span aria-hidden="true" class="remove exercise-remove">×</span>\
                                        </button>\
                                </div>');
        })
        
    });
    
    
</script>