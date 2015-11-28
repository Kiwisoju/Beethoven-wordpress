<?php foreach($lessonQuestions as $questionNumber => $question):?>
                                <div class="question-wrapper question-wrapper-<?php echo $questionNumber+1 ?> <?php echo $questionNumber > 0 ? 'question-wrapper--hidden' : '' ?> ">
                                    <div id="interval-question" class="question-container row">
                                        <span class="pull-right question-number">
                                            <?php echo $questionNumber+1; ?>
                                            /
                                            <?php echo count($lessonQuestions) ?>
                                        </span>
                
                                        <div class="question-title">
                                            <span>Question <?php echo $questionNumber+1 ?>: What interval is being played here?</span>
                                        </div>
                                        <div class="audio-container">
                                            <div class="player">
                                                <audio controls>
                                                    <source src="<?php echo home_url('/') .'wp-content/themes/industry/sounds/intervals/' . $question->question ?>_<?php echo $question->answer?>.ogg" type="audio/ogg">
                                                    <source src="<?php echo home_url('/') .'wp-content/themes/industry/sounds/intervals/' . $question->question ?>_<?php echo $question->answer?>.mp3" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="interval-answer" class="answer-container row">
                                        <div class="question-options">
                                            <button class="lesson-button btn" data-value="min_2">Minor 2nd</button> 
                                            <button class="lesson-button btn" data-value="maj_2">Major 2nd</button> 
                                            <button class="lesson-button btn" data-value="min_3">Minor 3rd</button> 
                                            <button class="lesson-button btn" data-value="maj_3">Major 3rd</button> 
                                            <button class="lesson-button btn" data-value="per_4">Perfect 4th</button> 
                                            <button class="lesson-button btn" data-value="aug_4">Tritone</button> 
                                            <button class="lesson-button btn" data-value="per_5">Perfect 5th</button>
                                            <button class="lesson-button btn" data-value="min_6">Minor 6th</button>
                                            <button class="lesson-button btn" data-value="maj_6">Major 6th</button>
                                            <button class="lesson-button btn" data-value="min_7">Minor 7th</button>
                                            <button class="lesson-button btn" data-value="maj_8">Major 7th</button>
                                            <button class="lesson-button btn" data-value="oct">Octave</button>
                                        </div>
                                        <input type="hidden" class="answer-<?php echo $questionNumber+1 ?>" name="form[answer]" value="<?php echo $question->answer ?>"/>
                                    </div>
                                </div>
                            <?php endforeach ?>