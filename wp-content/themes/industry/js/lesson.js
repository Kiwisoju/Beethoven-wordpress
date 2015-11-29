jQuery(function() {
    var $ = jQuery,
        hideQuestionClass = 'question-wrapper--hidden',
        currentQuestionNum = 1,
        studentAnswers = {},
        answers = {},
        results = '',
        score = 0,
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
        
        var filteredNote = note;
        var notes = [];
        
        // Adding accidental if present.
        if(note.indexOf("_sharp") > -1){
            filteredNote = note.replace("_sharp", "#");
            notes = [ new Vex.Flow.StaveNote({ keys: [filteredNote + "/4"], duration: "w" })
            .addAccidental(0, new Vex.Flow.Accidental("#"))];
        }else if(note.length == 2 && note.substr(-1) === "b" ){
            notes = [ new Vex.Flow.StaveNote({ keys: [note + "/4"], duration: "w" })
            .addAccidental(0, new Vex.Flow.Accidental("b"))];
        }else{
            notes = [ new Vex.Flow.StaveNote({ keys: [note + "/4"], duration: "w" }) ];
        }
        
        //console.log(note);
        var canvas = $(".question-wrapper-" + currentQuestionNum + " " + "canvas")[0];
        var renderer = new Vex.Flow.Renderer(canvas,
        Vex.Flow.Renderer.Backends.CANVAS);
        
        var ctx = renderer.getContext();
        var stave = new Vex.Flow.Stave(10, 0, 500);
        stave.addClef("treble").setContext(ctx).draw();
        
        var voice = new Vex.Flow.Voice({
            num_beats: 1,
            beat_value: 1,
            resolution: Vex.Flow.RESOLUTION
          });
        
        // Add notes to voice
        voice.addTickables(notes);
        
        // Format and justify the notes to 500 pixels
        var formatter = new Vex.Flow.Formatter().joinVoices([voice]).format([voice], 500);
        
        // Render voice
        voice.draw(ctx, stave);
    }
    
    function getQueryVariable(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
    }
    
    // Handle click of question answer options
    $('.question-options button').click(function() {
        var buttonElement = $(this);
        
        var studAnswer = buttonElement.data('value');
        var quizAnswer = $('.answer-'+currentQuestionNum).val();
        
        // compare students answer and actual answer to record score for
        // ear trainer.
        if(studAnswer == quizAnswer){
            score ++;
        }
        
        
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
            // All answers recorded
            showNextQuestion(currentQuestionNum, ++currentQuestionNum);
            // Display the results div
            $('.results').show();
            
            // Collate the data
            var formData = {};
            formData['answers'] = answers;
            formData['studentAnswers'] = studentAnswers; 
            formData['lesson_id'] = $('#lesson_id').val();
            
            
            
            if(getQueryVariable('type')){
                console.log('This was just ear training, no need to save nothun!');
                 
            }else{
                // Send to app.processor to AJAX data to PHP script
                app.processor.results(formData);  
            }
            $('#score').append(score);
            
        }
       
    });
    
    $(document).on('ready', function(){
        (function(d, p){
            var a = new XMLHttpRequest(),
                b = d.body;
            a.open("GET", p, true);
            a.send();
            a.onload = function(){
                var c = d.createElement("div");
                c.style.display = "none";
                c.innerHTML = a.responseText;
                b.insertBefore(c, b.childNodes[0]);
            }
            })(document, "../../../wp-content/themes/industry/images/svg/sprite.svg");
            
        plyr.setup();
        
        if($('canvas') ){
            renderNotation();
        }
    });
    
});
  