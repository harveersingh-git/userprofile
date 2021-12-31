$(document).ready(function(){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    
    $(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });
    
    $('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    });
    
    $(".submit").click(function(){
    return false;
    })
    
    });



    // On ready
$(document).ready(function() {

  // Set up our dropzone
  $('#in_available_fields').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    start: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      checkFields()
    },
    stop: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass("panel-danger").addClass('panel-primary');
      }
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

  // Enable dropzone for primary fields
  $('.primaryDropzone').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    receive: function(event, ui) {
      // If we dont allow primary fields here, cancel
      if (!$(ui.item).hasClass("allowPrimary")) {
        // $(ui.placeholder).css('display', 'none');
        $(ui.sender).sortable("cancel");
      }
    },
    over: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(ui.placeholder).css('display', 'none');
      } else {
        $(ui.placeholder).css('display', '');
      }
    },
    start: function(event, ui) {
      checkFields()
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
        
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

  // Enable dropzone for secondary fields
  $('.secondaryDropzone').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    receive: function(event, ui) {
      // If we dont allow secondary fields here, cancel
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(ui.sender).sortable("cancel");
      }
    },
    over: function(event, ui) {
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(ui.placeholder).css('display', 'none');
      } else {
        $(ui.placeholder).css('display', '');
      }
      checkFields();
    },
    start: function(event, ui) {
      // if (!$(ui.item).hasClass("allowPrimary")) {
      //   $(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
      // }
      // if (!$(ui.item).hasClass("allowSecondary")) {
      //   $(".secondaryPanel").removeClass('panel-primary').addClass("panel-danger");
      // }
      // if (!$(ui.item).hasClass("allowExport")) {
      //   $(".exportPanel").removeClass('panel-primary').addClass("panel-danger");
      // }
      checkFields();
    },
    // stop: function(event, ui) {
    //   if (!$(ui.item).hasClass("allowPrimary")) {
    //     $(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
    //   }
    //   if (!$(ui.item).hasClass("allowSecondary")) {
    //     $(".secondaryPanel").removeClass("panel-danger").addClass('panel-primary');
    //   }
    //   if (!$(ui.item).hasClass("allowExport")) {
    //     $(".exportPanel").removeClass("panel-danger").addClass('panel-primary');
    //   }
    // },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {
        // var order = new Array();
        // $('#sortable>li').each(function(index, element) {
           
        //     order.push({
        //             id: $(this).attr("id"),
        //             positionn: index + 1,
        //             type:'2'

        //         }

        //     );
        //     console.log('idddd', order);
        // });
      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

  // Enable dropzone for export fields
  $('.exportDropzone').sortable({
    connectWith: '.sortable-list',
    placeholder: 'placeholder',
    receive: function(event, ui) {
      // If we dont allow export fields here, cancel
      if (!$(ui.item).hasClass("allowExport")) {
        $(ui.sender).sortable("cancel");
      }
      checkFields();
    },
    over: function(event, ui) {
      if (!$(ui.item).hasClass("allowExport")) {
        $(ui.placeholder).css('display', 'none');
      } else {
        $(ui.placeholder).css('display', '');
      }
      checkFields();
    },
    start: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass('panel-primary').addClass("panel-danger");
      }
      checkFields()
    },
    stop: function(event, ui) {
      if (!$(ui.item).hasClass("allowPrimary")) {
        $(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowSecondary")) {
        $(".secondaryPanel").removeClass("panel-danger").addClass('panel-primary');
      }
      if (!$(ui.item).hasClass("allowExport")) {
        $(".exportPanel").removeClass("panel-danger").addClass('panel-primary');
      }
    },
    change: function(event, ui) {
      checkFields();
    },
    update: function(event, ui) {

      checkFields();
    },
    out: function(event, ui) {
      checkFields();
    }
  }).disableSelection();

});

// Checks to see if the fields section has fields selected. If not, shows a placeholder
function checkFields() {
  if ($('[name=in_primary_fields] li').length >= 1) {
    $('.primaryPanel').find('.alert').hide();
  } else {
    $('.primaryPanel').find('.alert').show();
  }

  if ($('[name=in_secondary_fields] li').length >= 1) {
    $('.secondaryPanel').find('.alert').hide();
  } else {
    $('.secondaryPanel').find('.alert').show();
  }

  if ($('[name=in_export_fields] li').length >= 1) {
    $('.exportPanel').find('.alert').hide();
  } else {
    $('.exportPanel').find('.alert').show();
  }
}



