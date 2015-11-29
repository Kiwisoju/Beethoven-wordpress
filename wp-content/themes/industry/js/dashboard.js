jQuery(function($){
    
    // Extending sidemenu height to reach bottom fo the page
    $(document).on('ready', function(){
        // Init form validation
        app.dashboardFunctions.validator();
        // Init the sidemenu
        app.dashboardFunctions.initMenu();
        // Setting the side menu height
        app.dashboardFunctions.setSideMenuHeight();
        
        // Setting the active menu item
        
        var url = window.location.pathname,
            pathName = url.substr(1),
            accountType = pathName.substr(0, pathName.indexOf('/') );
        if(accountType == 'student'){
            app.dashboardFunctions.studentActiveMenuItem(pathName);
        }else{
            app.dashboardFunctions.teacherActiveMenuItem(pathName);
        }
        
        $(document).on('change', function(){
           app.dashboardFunctions.setSideMenuHeight(); 
        });
    });
});