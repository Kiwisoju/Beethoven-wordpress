jQuery(function($){
   function initDashboardLessonResults() {
        var teacherAdminData = window.teacherAdminData, 
            resultsContainerElement = $('.lesson-results-container');
       
        $('.lesson-select .lesson-item').click(function() {
            var lessonItemElement = $(this),
                lessonId = lessonItemElement.data('lessonId'),
                lessonName = teacherAdminData.lessons[lessonId]['name'];
            
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
            teacherAdminData = window.teacherAdminData,
            lessonName = teacherAdminData.lessons[lessonId]['name'],
            lessonResults = teacherAdminData.lessonResults[lessonId],
            graphData = {
                labels: [],
                datasets: [{
                    fillColor: "rgba(211,179,233,0.7)",
                    strokeColor: "rgba(194,137,216,0.7)",
                    highlightFill: "rgba(197,155,213,0.7)",
                    highlightStroke: "rgba(181,124,202,0.7)",
                    data: []
                }],
                test:[]
            };
            
        graphLessonTitleElement.html(lessonName);
        
        // Check if any results
        if (lessonResults) {
            resultsContainerElement.html('');
            $.each(lessonResults, function(studentId, score) {
                // Add data for graph here var myBarChart = new Chart(ctx).Bar(data, options);
                var studentName = teacherAdminData.students[studentId];
                
                // Add each student's name
                graphData.labels.push(studentName);
                    
                // Add student's score to graph dataset
                graphData.datasets[0].data.push(score);
            });
                
            updateResultsGraph(graphData);
        } else {
            // Handle no results
            resultsContainerElement.html('Sorry, no students have completed that lesson yet');
            
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
            });
    
        };
   
   initDashboardLessonResults();
   
});

