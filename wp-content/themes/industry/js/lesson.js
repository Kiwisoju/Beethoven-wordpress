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
    
    function displayResults(){
        // Update results div
        results += '<div class="results-row">\
                            <span class="answer">' + answers.q+currentQuestionNum + '</span>\
                            <span class="student-answer">' + studentAnswers.q+currentQuestionNum + '</span>\
                        </div>';
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
        } else {
            // Do something, all questions answered and recorded in studentAnswers object
            // Display their results up against the actual answers with a button to go back
            // to the lesson overview page.
            showNextQuestion(currentQuestionNum, ++currentQuestionNum);
            // Display the results div
            $('.results').show();
            
            // Fill the results div with results
            $('.results-container').append(displayResults());
            
            // Send data ajax?
            console.log(studentAnswers);
            console.log(answers);
        }
       
    });
})