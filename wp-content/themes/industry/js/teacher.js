function initMenu() {
    jQuery('#menu ul').hide();
    jQuery('#menu ul').children('.current').parent().show();
    //jQuery('#menu ul:first').show();
    jQuery('#menu li a').click(function(){
        console.log('clicked menu item');
        var checkElement = jQuery(this).next();
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            return false;
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            jQuery('#menu ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            return false;
        }
    });
}

jQuery(document).ready(function($){
    initMenu();
    jQuery("#menu-toggle").click(function(e) {
        e.preventDefault();
        console.log('menu toggle 1 clicked');
        jQuery("#wrapper").toggleClass("toggled");
    });
    
    glennsFormValidator.init();
   
   
   $('input[type=submit]').attr('disabled', true);
   
   $('.required').on('blur', function(){
      // Checking if there is an error class
      console.log($('.error').length);
      if($('.validated').length === $('.required').length){
         // Enabling the submit button.
         console.log('enable button');
         $('input[type=submit]').attr('disabled', false);
      }else{
         $('input[type=submit]').attr('disabled', true);
      }
   });
   
   function initDashboardLessonResults() {
        var teacherAdminData = window.teacherAdminData, 
            resultsContainerElement = $('.lesson-results-container');
       
        $('.lesson-select .lesson-item').click(function() {
            var lessonItemElement = $(this),
                lessonId = lessonItemElement.data('lessonId'),
                lessonName = teacherAdminData.lessons[lessonId]['name'];
                
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
                }]
            };
            
        graphLessonTitleElement.html(lessonName);
        
        // Check if any results
        if (lessonResults) {
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
        
        ctx.canvas.height = $('.lesson-results-container').height();
        ctx.canvas.width = $('.lesson-results-container').width();
        
        myBarChart = new Chart(ctx).Bar(data);
    
        };
   
   initDashboardLessonResults();
   
});

