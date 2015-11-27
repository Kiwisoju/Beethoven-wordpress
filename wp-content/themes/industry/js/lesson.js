jQuery(function() {
    var $ = jQuery,
        hideQuestionClass = 'question-wrapper--hidden',
        currentQuestionNum = 1,
        studentAnswers = {},
        answers = {},
        results = '',
        totalQuestionsNum;
    
    // Find out total number of questions for lesson
    totalQuestionsNum = $('.question-wrapper').length;
    
    function showNextQuestion(currentQuestionNum, nextQuestionNum) {
        $('.question-wrapper-' + currentQuestionNum).toggleClass(hideQuestionClass, true);
        $('.question-wrapper-' + nextQuestionNum).toggleClass(hideQuestionClass, false);
    }
    
    function updateProgressBar(currentQuestionNum, totalQuestionsNum) {
        var progressPercentage = (currentQuestionNum / totalQuestionsNum) * 100;
        $('.progress .progress-bar').css('width', (progressPercentage + '%'));
    }
    
    function renderNotation(note){
        note = (note) ? note : $(".question-wrapper-" + currentQuestionNum + " " + "canvas").data('value');
        //console.log(note);
        var canvas = $(".question-wrapper-" + currentQuestionNum + " " + "canvas")[0];
        var renderer = new Vex.Flow.Renderer(canvas,
        Vex.Flow.Renderer.Backends.CANVAS);
        
        var ctx = renderer.getContext();
        var stave = new Vex.Flow.Stave(10, 0, 500);
        stave.addClef("treble").setContext(ctx).draw();
        
        
        // Create the notes
        var notes = [ new Vex.Flow.StaveNote({ keys: [note + "/4"], duration: "w" }) ];
        
        var voice = new Vex.Flow.Voice({
            num_beats: 1,
            beat_value: 1,
            resolution: Vex.Flow.RESOLUTION
          });
        
          // Add notes to voice
          voice.addTickables(notes);
        
          // Format and justify the notes to 500 pixels
          var formatter = new Vex.Flow.Formatter().
            joinVoices([voice]).format([voice], 500);
        
          // Render voice
          voice.draw(ctx, stave);
    }
    // Handle click of question answer options
    $('.question-options button').click(function() {
        var buttonElement = $(this);
        
        // Record student's answer
        studentAnswers['q' + currentQuestionNum] = buttonElement.data('value');
        
        // Record actual answer
        answers['q' + currentQuestionNum] = $('.answer-'+currentQuestionNum).val();
        
        
        // Update the progress bar 
        updateProgressBar(currentQuestionNum, totalQuestionsNum);
        
        // Only show next question when not the last one
        if (currentQuestionNum < totalQuestionsNum) {
            // Hide current question and show the next, also increment current question
            showNextQuestion(currentQuestionNum, ++currentQuestionNum);
            
            if($('canvas') ){
                var note = $(".question-wrapper-" + currentQuestionNum + " " + "canvas").data('value');
                console.log(note);
                renderNotation(note);
            }
        } else {
            // Do something, all questions answered and recorded in studentAnswers object
            // Display their results up against the actual answers with a button to go back
            // to the lesson overview page.
            showNextQuestion(currentQuestionNum, ++currentQuestionNum);
            // Display the results div
            $('.results').show();
            
            // collate the data
            var formData = {};
            formData['answers'] = answers;
            formData['studentAnswers'] = studentAnswers; 
            formData['lesson_id'] = $('#lesson_id').val();
            app.processor.results(formData);
        }
       
    });
    
    $(document).on('ready', function(){
       if($('canvas') ){
           renderNotation();
       } 
    });
})