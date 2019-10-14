
jQuery(function () {
    var manageCatTable;
    manageCatTable = jQuery('#theme_option_table').dataTable( {
        "language": {
            "emptyTable": "No data available"
        },
    } );
    $('#field_type').on('change', function() {
        $('#select_options').css('display', 'none');
        if ( $(this).val() === 'select' ) {
            $('#select_options').fadeIn();
        }else if ( $(this).val() === 'multi_select' ) {
          $('#select_options').fadeIn();
        }else if ( $(this).val() === 'radio' ) {
          $('#select_options').fadeIn();
        }else if ( $(this).val() === 'multicheck' ) {
          $('#select_options').fadeIn();
        }else if ( $(this).val() === 'custom_taxonomy' ) {
          $('#custom_taxonomy').fadeIn();
        }else if ( $(this).val() === 'info' ) {
          $('#custom_info').fadeIn();
        }else{
            $('#select_options').fadeOut();
        }
    });
    jQuery('.add_more').click(function(){
        jQuery('#appear_filed').append('<li>'+
          '<div class="option_field_more" style="margin-bottom:5px;">'+
          '<input type="text" id="option_title" name="option_title[]" class="form-control" placeholder="Option Title"/>'+
          '<input type="text" id="option_value"  name="option_value[]" class="form-control" placeholder="Option Value" style="margin-top:5px;"/>' +
          '<a href="javascript:void(0);" class="remove" style="margin-left:4px;color:#F00;font-weight:bold;">Remove</a></div></li>');
        jQuery('.remove').click(function(){
            jQuery(this).parent().parent().remove();
        });
    });

    jQuery('.remove').click(function(){
        jQuery(this).parent().parent().remove();
    });
});

