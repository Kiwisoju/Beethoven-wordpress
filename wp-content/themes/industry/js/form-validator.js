var glennsFormValidator = {
    myRequiredFields: document.getElementsByClassName('required'),

    checkRequiredFields : function(){
        var myRequiredFields = (this.myRequiredFields.length) ? this.myRequiredFields : 'error';

        if(myRequiredFields != 'error'){
            //loop over all required fields
            for(var i=0; i < myRequiredFields.length; i++){
               //check if value property == ''
                if(!myRequiredFields[i].value){
                    myRequiredFields[i].style.borderColor = '#f00';
                }
            }
        }
},
    init: function(){
        for(var i=0; i < this.myRequiredFields.length; i++){
           this.myRequiredFields[i].addEventListener("blur", function(){
                // Check if there is an email field, if there is then it requires an @ and a .
                if(jQuery(this).hasClass('email') ){
                    if(this.value.indexOf('@') === -1 || this.value.indexOf('.') === -1 ){
                        this.style.borderColor="rgb(191, 48, 48)";
                        this.style.backgroundColor="#FFE4E4";
                        // Insert a message into notificationBox stating that is not a valid email.
                        jQuery('.notification-message').html('Please enter a valid email address.');
                        this.setAttribute("class", "form-control required email error");
                        
                    }else{
                        this.style.borderColor="rgb(119, 202, 119)";
                        this.style.backgroundColor="#DBFFDB";
                        jQuery('.notification-message').html('');
                        this.setAttribute("class", "form-control required email validated");
                    }
                    
                }
                else if(!this.value){
                   this.style.borderColor="rgb(191, 48, 48)";
                   this.style.backgroundColor="#FFE4E4";
                   this.setAttribute("class", "form-control required error");
                   
                   
                }else{
                   this.style.borderColor="rgb(119, 202, 119)";
                   this.style.backgroundColor="#DBFFDB";
                   this.setAttribute("class", "form-control required validated");
               }
             // glennsFormValidator.checkRequiredFields();
           });
        }
        
    }
};

