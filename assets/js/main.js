
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
        }else if ( $(this).val() === 'switch' ) {
          $('#select_options').fadeIn();
        }else if ( $(this).val() === 'multicheck' ) {
          $('#select_options').fadeIn();
        }else if ( $(this).val() === 'custom_taxonomy' ) {
          $('#custom_taxonomy').fadeIn();
        }else if ( $(this).val() === 'info' ) {
          $('#custom_info').fadeIn();
        }else if ( $(this).val() === 'images' ) {
          $('#select_images').fadeIn();
        }else{
            $('#select_options').fadeOut();
            $('#select_images').fadeOut();
            $('#custom_info').fadeOut();
            $('#custom_taxonomy').fadeOut();
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

    jQuery("#option_images_button").on("click",function () {
        var images = wp.media({
            title: 'Upload Image',
            library: {type: 'image'},
            multiple: true,
        }).open().on("select", function(e){
            var uploadImages = images.state().get("selection");
            var getImage = uploadImages.toJSON();
            $(getImage).each(function (key,image) {
                jQuery('#append_multiple_images').append('<div class="image_box">'+
                  '<input type="hidden" name="option_images[]" value="'+image.url+'" />'+
                  '<img src="'+image.url+'" height="100px;" /><br>'+
                  '<a title="Remove Image" onclick="jQuery(this).parent().remove();">Remove Image</a>'+
                  '</div>');
            });

        });
    });
});

