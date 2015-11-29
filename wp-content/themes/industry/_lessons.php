<div class="wrap" id="lessons-overview">
    <h2 class="title">Lessons Overview</h2>
    
    <div class="row">
        <button type="button" id="past-lessons-button" class="btn primary-button lessons-overview-button">Current Lessons</button>
        <button type="button" id="current-lessons-button" class="btn primary-button lessons-overview-button">Past Lessons</button>
    </div>
    
    
    <div class="table-container">
        <div class="toggle" id="current-lessons"><?php
            include '_lesson_current.php';    
      ?></div>
        <div class="toggle" id="past-lessons"><?php
            include '_lesson_past.php';    
      ?></div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).on('ready', function(){
       jQuery('.primary-button').on('click', function(e){
           e.preventDefault();
           if(e.currentTarget.innerHTML == 'Current Lessons'){
               jQuery('#current-lessons').show();
               jQuery('#past-lessons').hide();
               
               jQuery('#past-lesson-button').css('backgroundColor', '#639FCC');
               jQuery('#current-lessons-button').css('backgroundColor', '#8EBDE0');
           }else if(e.currentTarget.innerHTML == 'Past Lessons'){
               jQuery('#current-lessons').hide();
               jQuery('#past-lessons').show();
               
               jQuery('#current-lessons-button').css('backgroundColor', '#639FCC');
               jQuery('#past-lessons-button').css('backgroundColor', '#8EBDE0');
           }
           console.log(e.currentTarget.innerHTML);
       });
    });
</script>