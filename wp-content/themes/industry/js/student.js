jQuery(document).ready(function($){
    
    function initDashboardLessonResults() {
        var studentAdminData = window.studentAdminData, 
            resultsContainerElement = $('.lesson-results-container');
        $('.lesson-select .lesson-item').click(function() {
            var lessonItemElement = $(this),
                lessonId = lessonItemElement.data('lessonId'),
                lessonName = studentAdminData.lessons[lessonId]['lesson_name'];
            
            // Remove selected class from previous selected
            $('.lesson-selected').attr('class', '');
            // Add selected class to selected item
            lessonItemElement.closest('li').attr('class', 'lesson-selected');
            
            console.log('Lesson: ' + lessonName + ' selected');
            updateDashboardLessonResultsContainer(lessonId);
        });
    }
    
    function updateDashboardLessonResultsContainer(lessonId) {
        var resultsContainerElement = $('.lesson-results-container'),
            graphLessonTitleElement = $('#graph-lesson-title'),
            studentAdminData = window.studentAdminData,
            lessonName = studentAdminData.lessons[lessonId]['lesson_name'],
            studentsAnswers = studentAdminData.lessons[lessonId]['studentAnswers'],
            lessonAnswers = studentAdminData.lessons[lessonId]['answers'],
            graphData = {
                labels: [],
                datasets: [{
                    fillColor: "rgba(23,118,182,0.7)",
                    strokeColor: "rgba(0,110,183,0.7)",
                    highlightFill: "rgba(23,118,182,0.85)",
                    highlightStroke: "rgba(0,110,183,0.85)",
                    data: []
                }],
                studentAnswers: []
            };
        
            
            
        graphLessonTitleElement.html(lessonName);
        
        // Check if any results
        if (!$.isEmptyObject(studentsAnswers)) {
            resultsContainerElement.html('');
            for(var i = 0; i < lessonAnswers.length; i++){
                graphData.labels.push(lessonAnswers[i]['answer']);
                graphData.studentAnswers.push(studentsAnswers[i]['student_answer']);
                if(lessonAnswers[i]['answer'] == studentsAnswers[i]['student_answer']){
                    graphData.datasets[0].data.push('100');
                }else{
                    graphData.datasets[0].data.push('0');
                }
            }
               
             updateResultsGraph(graphData);
        } else {
            // Handle no results
            resultsContainerElement.html("You haven't completed this lesson yet");
            resultsContainerElement.append('<br><a class="btn module-button" href="lessons/lesson/?lesson=' + lessonId + '">Go To Lesson Now</a>');
            
        }
    }
    
    function updateResultsGraph(data) {
        $('#graph').remove();
        $('.lesson-results-container').append('<canvas id="graph"><canvas>');
        var canvas = $('#graph')[0],
            ctx = canvas.getContext("2d"),
            myBarChart;
        
        myBarChart = new Chart(ctx).Bar(data, {
                responsive: true,
                tooltipTemplate: function (d) {
                    return 'Your Answer: ' + data.studentAnswers[data.labels.indexOf(d.label)]
                },
                scaleLabel: "<%=value%>"
            });
    
        };
   
   initDashboardLessonResults(); 
});