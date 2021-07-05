jQuery(document).ready(function(){
  if(jQuery('tr.meta_layout input[value=option2]').is(":checked")){
    jQuery('tr.meta_sidebar').show();
  }
  else if(jQuery('tr.meta_layout input[value=option2]').not(":checked")){
    jQuery('tr.meta_sidebar').hide();
  }
});

jQuery(document).ready(function(){
  jQuery('input[type=radio]').change(function() {
    if(jQuery('tr.meta_layout input[value=option2]').is(":checked")){
      jQuery('tr.meta_sidebar').fadeIn();
    }
    else if(jQuery('tr.meta_layout input[value=option2]').not(":checked")){
      jQuery('tr.meta_sidebar').fadeOut();
    }
  }); 
});