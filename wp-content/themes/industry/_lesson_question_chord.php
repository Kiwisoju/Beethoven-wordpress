<?php foreach($lessonQuestions as $questionNumber => $question):?>
                                <div class="question-wrapper question-wrapper-<?php echo $questionNumber+1 ?> <?php echo $questionNumber > 0 ? 'question-wrapper--hidden' : '' ?> ">
                                    <div id="interval-question" class="question-container row">
                                        <span class="pull-right question-number">
                                            <?php echo $questionNumber+1; ?>
                                            /
                                            <?php echo count($lessonQuestions) ?>
                                        </span>
                
                                        <div class="question-title">
                                            <span>Question <?php echo $questionNumber+1 ?>: What chord is being played here?</span>
                                        </div>
                                        <div class="audio-container">
                                            <div class="player">
                                                <audio controls>
                                                    <source src="<?php echo home_url('/') .'wp-content/themes/industry/sounds/chords/' . $question->question ?>_<?php echo $question->answer?>.ogg" type="audio/ogg">
                                                    <source src="<?php echo home_url('/') .'wp-content/themes/industry/sounds/chords/' . $question->question ?>_<?php echo $question->answer?>.mp3" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="interval-answer" class="answer-container row">
                                        <div class="question-options">
                                            <button class="lesson-button btn" data-value="maj">Major</button> 
                                            <button class="lesson-button btn" data-value="min">Minor</button> 
                                            <button class="lesson-button btn" data-value="aug">Augmented</button> 
                                            <button class="lesson-button btn" data-value="dim_7">Diminished 7th</button> 
                                            <button class="lesson-button btn" data-value="dom_7">Dominant 7th</button> 
                                            <button class="lesson-button btn" data-value="maj_7">Major 7th</button> 
                                            <button class="lesson-button btn" data-value="min_7">Minor 7th</button>
                                        </div>
                                        <input type="hidden" class="answer-<?php echo $questionNumber+1 ?>" name="form[answer]" value="<?php echo $question->answer ?>"/>
                                    </div>
                                </div>
                            <?php endforeach ?>