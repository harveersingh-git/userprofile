 var type = '';
$(function() {
    var today = new Date(); 
    var dd = today.getDate(); 
    var mm = today.getMonth()+1; //January is 0! 
    var yyyy = today.getFullYear(); 
    if(dd<10){ dd='0'+dd } 
    if(mm<10){ mm='0'+mm } 
    var today = dd+'/'+mm+'/'+yyyy; 

    $("#joining_date").datepicker(
        {
            dateFormat: 'yy-mm-dd',
           
        }

    );
    $(".edu_to").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $(".edu_from").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $(".exp_from").datepicker(
        {
            dateFormat: 'yy-mm-dd'
        }
    );
    $(".exp_to").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});


$(document).ready(function() {
   
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var expAddButton = $('.exp_add_button'); //Add button selector
    var certificationAddButton = $('.certification_add_button'); //Add button selector
    var achAddButton = $('.ach_add_button'); //Add button selector
    var projectAddButton = $('.project_add_button'); //Add button selector

    
    
    var wrapper = $('.education_more'); //Input field wrapper
    var project_wrapper = $('.project_more'); //Input field wrapper
    var ach_wrapper = $('.ach_more'); //Input field wrapper
    var exp_wrapper = $('.exp_more'); //Input field wrapper
    var certification_wrapper = $('.certification_more'); //Input field wrapper


    // var fieldHTML ='<div class="row"><div class="col-lg-3"><label>Type</label>';
    // fieldHTML += '<select class="form-control" aria-label="Default select example" name="edu_type[]"><option selected>--please select--</option>'+type+'</select></div>';
    // fieldHTML += '<div class="col-lg-3"><label>Title</label> <select class="form-control" name="edu_title[]" aria-label="Default select example"><option selected>--please select--</option><option value="1">BBA</option><option value="2">BCA</option><option value="3">B.Come</option></select>';
    // fieldHTML += '</div><div class="col-lg-3"><label>From</label><input type="text" class="form-control edu_from" placeholder="2021-01-01" name="edu_to[]" value="" required="" autocomplete="on|off">';
    // fieldHTML += '</div><div class="col-lg-3"><label>To</label><input type="text" class="form-control edu_to" placeholder="2021-02-01" name="edu_from[]" value="" required="" autocomplete="on|off">';
    // fieldHTML += '</div><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>'; //New input field html 
   







    


  

 
    var x = 1; //Initial field counter is 1
  

     //Once add button is clicked
     $(projectAddButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter

            var projectFieldHTML = '<div class="row">';
            projectFieldHTML += '<div class="col-lg-3"><label>Project Name</label>';
            projectFieldHTML += '<input type="text" class="form-control" placeholder="XYZ" name="project_name[]" value="" required="" autocomplete="on|off">';
            projectFieldHTML += '</div><div class="col-lg-3"><label>Project Skills</label>';
            projectFieldHTML += '<input type="text" class="form-control" placeholder="php,node etc" name="project_skills[]" value="" required="" autocomplete="on|off">';
            projectFieldHTML += '</div>';
            projectFieldHTML += '<div class="col-lg-3"><label>Team Size</label>';
            projectFieldHTML += '<input type="text" class="form-control" placeholder="1" name="team_size[]" value="" required="" autocomplete="on|off">';
            projectFieldHTML += '</div>'
            projectFieldHTML += '<div class="col-lg-3"><label>Url</label>';
            projectFieldHTML += '<input type="text" class="form-control" placeholder="https://github.com/" name="url[]" value=""required="" autocomplete="on" />';
        
            
            projectFieldHTML += '<div class="row"><label>Project Description</label>';
            projectFieldHTML += '<textarea class="form-control ckeditor" rows="3" name="project_description[]" id="project_description'+x+'" required=""></textarea>';
            projectFieldHTML += '</div>';
            projectFieldHTML += '</div>';
        
            projectFieldHTML += '<a href="javascript:void(0);" class="project_remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>';
        
            $(project_wrapper).append(projectFieldHTML); //Add field html
          
        }
        setTimeout(function(){
            CKEDITOR.replace('project_description'+x);

    }, 2000);


    });
     //Once add button is clicked
     $(achAddButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter

            var achFieldHTML = '<div class="row"><div class="col-lg-12"><label><i class="fa fa-arrows" aria-hidden="true"></i>Title </label>';
            achFieldHTML +='<input type="text" class="form-control" placeholder="EX:abc" name="title[]" value="" required="" autocomplete="on|off">';
            achFieldHTML +='</div><div class="col-lg-12"><label>Achievement Description </label>';
            achFieldHTML +='<textarea class="form-control ckeditor" rows="3" name="description[]" id="description'+x+'"></textarea></div>';
            achFieldHTML +='<a href="javascript:void(0);" class="ach_remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>';
           
            $(ach_wrapper).append(achFieldHTML); //Add field html
          
        }
        setTimeout(function(){
            CKEDITOR.replace('description'+x);

    }, 2000);

    });

    //Once add button is clicked
    $(addButton).click(function() {
         var token = $('input[name="_token"]').attr('value');
         var order_numbern = 1;
        $.ajax({
            type: 'GET',
            url: '/education_type',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': token
            },

            success: function(result) {

                result.data.forEach(element =>{
                 
                    type += "<option value="+element.id+">"+element.value+"</option>"
                } );
             var fieldHTML ='<div class="row"><div class="col-lg-3"><label><i class="fa fa-arrows" aria-hidden="true"></i>Type</label>';
                fieldHTML += '<select class="form-control" aria-label="Default select example" name="edu_type[]"><option selected>--please select--</option>'+type+'</select></div>';
                fieldHTML += '<div class="col-lg-3"><label>Title</label> <select class="form-control" name="edu_title[]" aria-label="Default select example"><option selected>--please select--</option><option value="1">BBA</option><option value="2">BCA</option><option value="3">B.Come</option></select>';
                fieldHTML += '</div><div class="col-lg-3"><label>From</label><input type="text" class="form-control edu_from" placeholder="2021-01-01" name="edu_to[]" value="" required="" autocomplete="on|off">';
                fieldHTML += '</div><div class="col-lg-3"><label>To</label><input type="text" class="form-control edu_to" placeholder="2021-02-01" name="edu_from[]" value="" required="" autocomplete="on|off">';
                fieldHTML += '</div><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>'; //New input field html 
   
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            $('.education_more').find(".edu_to").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('.education_more').find(".edu_from").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        }
        addediter()

            }
        })
      
  


    });

    $(certificationAddButton).click(function() {
        // alert(certification_wrapper);
        //Check maximum number of input fields
        var token = $('input[name="_token"]').attr('value');

        $.ajax({
            type: 'GET',
            url: '/education_type',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': token
            },

            success: function(result) {

                result.certificate.forEach(element =>{
                 
                    type += "<option value="+element.id+">"+element.value+"</option>"
                } );
          
   
      

            }
        })
        setTimeout(function(){
        if (x < maxField) {
            
            x++; //Increment field counter
            var certificationFieldHTML = '<div class="row"><div class="col-lg-3"><label>Type</label>';
            certificationFieldHTML += '<select class="form-control" aria-label="Default select example" name="certification_type[]"><option selected>--please select--</option>'+type+'</select></div>';

          
            certificationFieldHTML += '</div>';
            certificationFieldHTML += '</div>';
            certificationFieldHTML += '<div class="row"><div class="col-lg-12"><div class="form-group">';
            certificationFieldHTML += '<label><i class="fa fa-arrows" aria-hidden="true"></i>Certification </label>';
            certificationFieldHTML += '<textarea class="form-control" rows="3" name="certification[]" id="certification'+x+'"></textarea>';
            certificationFieldHTML += '</div></div><a href="javascript:void(0);" class="certification_remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>';
        
            $(certification_wrapper).append(certificationFieldHTML); //Add field html
            setTimeout(function(){
                CKEDITOR.replace('certification'+x);
    
        }, 2000);
        }
    }, 2000);
      
    });

    
    $(expAddButton).click(function() {
        // CKEDITOR.replace('role_res[]');c
        //Check maximum number of input fields
       
          
      
        if (x < maxField) {
           
            x++; //Increment field counter
            var expFieldHTML = '<div><div class="row"><div class="col-lg-3"><label><i class="fa fa-arrows" aria-hidden="true"></i>Companay Name</label>';
            expFieldHTML += '<input type="text" class="form-control" placeholder="XYZ" name="company_name[]" value="" required="" autocomplete="on|off">';
            expFieldHTML += '</div><div class="col-lg-3"><label>Designation</label><input type="text" class="form-control" placeholder="Team leader" name="designation[]" value="" required="" autocomplete="on|off">';
            expFieldHTML += '</div><div class="col-lg-3"><label>From</label><input type="text" class="form-control exp_from" placeholder="2021-01-01" name="exp_from[]" value="" required="" autocomplete="on|off" id="dp1639739620183">';
            expFieldHTML += '</div><div class="col-lg-3"><label>To</label><input type="text" class="form-control exp_to" placeholder="2021-01-01" name="exp_to[]" value="" required="" autocomplete="on|off" id="dp1639739620184">';
            expFieldHTML += '</div></div>';
            expFieldHTML += '<div class="row">';
            expFieldHTML += '<div class="col-lg-12">';
            expFieldHTML += '<div class="form-group">';
            expFieldHTML += '<label>Role and Responsibilities  </label>';
            expFieldHTML += '<textarea class="form-control ckeditorr" rows="3" name="role_res[]" id="role_ress'+x+'" required=""></textarea>';
            expFieldHTML += '</div>';
            expFieldHTML += '</div>';
            expFieldHTML += '</div><a href="javascript:void(0);" class="exp_remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>';
        
         $(exp_wrapper).append(expFieldHTML); //Add field html
            $('.exp_more').find(".exp_to").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('.exp_more').find(".exp_from").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        }
 
        setTimeout(function(){
                CKEDITOR.replace('role_ress'+x);
   
        }, 2000);
       


    });

    //Once remove button is clicked
    
    $(project_wrapper).on('click', '.project_remove_button', function(e) {
     
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    $(wrapper).on('click', '.remove_button', function(e) {
     
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    $(exp_wrapper).on('click', '.exp_remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    $(certification_wrapper).on('click', '.certification_remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    $(ach_wrapper).on('click', '.ach_remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    
    $(document).on('click', '#skills_prev', function(e) {
        e.preventDefault();
       $('#genral_info_button').hide();
       $('#genral_info_submit').show();
    });

    $(document).on('click', '#exprince_prev', function(e) {
        e.preventDefault();
       $('#skills_button').hide();
       $('#skills_submit').show();
    });

    $(document).on('click', '#project_previous', function(e) {
        e.preventDefault();
       $('#exprince_button').hide();
       $('#exprince_submit').show();
    });

    
    
//   function  addediter(){
   
//     }



});

 