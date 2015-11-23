<?php

if($_GET['edit']):?>
    <h2 class="title">Edit student</h2>
    <p>Use the form below to edit your student's profile.</p><?php

else:?>
    <h2 class="title">Add new student</h2>
    <p>Create a brand new student and add them to your classroom.</p><?php
endif;?>

<p>All fields marked with * are required</p>

<div class="row">
    <div class="col-xs-12 col-lg-6">
        <form id="student_form">
            <div class="form-group">
                <label for="first_name" class="sr-only">First Name</label>
                <input id="first_name" class="form-control" type="text" name="student['first_name']" placeholder="First Name *"/>
            </div>
            <div class="form-group">
                <label for="last_name" class="sr-only">Last Name</label>
                <input id="last_name" class="form-control" type="text" name="student['last_name']" placeholder="Last Name *"/>
            </div>
            <div class="form-group">
                <label for="user_email" class="sr-only">Email Address</label>
                <input id="user_email" class="form-control" type="text" name="student['user_email']" placeholder="Email Address *"/>
            </div>
            <div class="form-group select-style">
                <select id="classroom" class="form-control" name="student['classroom']"><?php
                // Here I need to query from the database to get all of the classes of which the
                // teacher is attached to, and render them into the options values.?>
                    <option value="default">Assign to Classroom</option>
                    <option value="11pt">11pt</option>
                    <option value="9dy">9DY</option>
                </select>
            </div>
            <div class="form-group" id="profile-image-container">
                <button class="btn btn-default secondary-button">Set Profile Picture</button>
                <div id="image-container">
                    <img src="https://placehold.it/170x170"></img>
                </div>
                
            </div>
            
            <input class="btn btn-default" type="submit" value="Submit"/>
        </form>
    </div>
</div>