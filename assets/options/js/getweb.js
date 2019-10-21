/**
 * Getweb js
 *
 * contains the core functionalities to be used
 * inside Getweb
 */

jQuery.noConflict();

String.prototype.capitalize = function() {
	return this.charAt(0).toUpperCase() + this.slice(1);
}

/** Fire up jQuery - let's dance!
 */
jQuery(document).ready(function($){

	//(un)fold options in a checkbox-group
	jQuery('.fld').click(function() {
		var $fold='.f_'+this.id;
		$($fold).slideToggle('normal', "swing");
	});

	//Color picker
	$( '.of-color' ).alphaColorPicker();

	//hides warning if js is enabled
	$('#js-warning').hide();

	//Tabify Options
	$('.group').hide();
	Array.prototype.containsSubString = function( text ){
		for ( var i in this )
		{
			if ( this[i].toString().indexOf( text ) != -1 )
				return i;
		}
		return -1;
	}

	Array.prototype.hasSubStringOf = function( text ){
		for ( var i in this )
		{
			if ( text.toString().indexOf( this[i].toString() ) != -1 )
				return i;
		}
		return -1;
	}

	var timeout;
	$("#search").on('keyup',  function(event) {
		var searchText = $("#search").val().toLowerCase().replace(/ +(?= )/g,'');

		window.clearTimeout(timeout);
		timeout = window.setTimeout(function(){
			if($.trim(searchText)){

				//Hide Nav
				$('#of_container #of-nav').hide();
				$('#of_container #content').removeClass('sidebar').addClass('no-sidebar');
				$('#of_container .group').show();
				//Show Search Result
				search(searchText);
			}else{

				//Show Nav and set tabs current
				$('#of_container #of-nav').show();
				$('#of_container #content').removeClass('no-sidebar').addClass('sidebar');
				$('#of_container .group').add('#of_container .group h2').hide();
				$('#of_container .group:first').show();
				$('#of_container #of-nav li').removeClass('current');
				$('#of_container #of-nav li:first').addClass('current');

				//Show all fields and hide no result
				$( "#content .group .section" ).show();
				$('#no-result').fadeOut(0);

			}
		},500);

	});

	function search(searchText) {
		$('#no-result').fadeOut(0);
		var section = $( "#content .group .section" ),
			resultFound = 0;

		section.hide();

		section.each(function( index ) {

			var titleText = '',
				$heading = $(this).find('.heading');

			if( $heading.length > 0){

				titleText = $heading.text().toLowerCase().split(" ");

				if( titleText && titleText.hasSubStringOf( searchText ) !== -1 ){

					$(this).fadeIn();
					resultFound = 1;

				}else{

					$(this).fadeOut();
				}

			}

		});

		if( resultFound == 0 ){
			$('#no-result').fadeIn(400);
		}

		resultFound = 0;
	}

	// Get the URL parameter for tab
	function getURLParameter(name) {
		return decodeURI(
			(RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,''])[1]
		);
	}

	// If the $_GET param of tab is set, use that for the tab that should be open
	if (getURLParameter('tab') != "") {
		$.cookie('of_current_opt', '#'+getURLParameter('tab'), { expires: 7, path: '/' });
	}

	// Display last current tab
	if ($.cookie("of_current_opt") === null) {
		$('.group:first').fadeIn('fast');
		$('#of-nav li:first').addClass('current');
	} else {

		$($.cookie("of_current_opt")).fadeIn().siblings('.group').fadeOut();
		$('#of-nav li a[href="'+$.cookie("of_current_opt")+'"]').parents('li').addClass('current');

	}

	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
		$(this).parent().parent().parent().find('.select-image-wrap').removeClass('pix-of-radio-img-selected');
		$(this).parent().addClass('pix-of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();

	// Style Select
	(function ($) {
		styleSelect = {
			init: function () {
				$('.select_wrapper').each(function () {
					$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
				});
				$('.select').live('change', function () {
					$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
				});
				$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
					$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
				});
			}
		};
		$(document).ready(function () {
			styleSelect.init()
		})
	})(jQuery);


	/** Aquagraphite Slider MOD */

	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide();

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".slide_edit_button").live( 'click', function(){
		//toggle for each
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});


	/**	Tipsy @since v1.3 */
	if (jQuery().tipsy) {
		$('.tooltip, .typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.7,
		});
	}


	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if (($.browser.msie && $.browser.version < 10) || $.browser.opera) {
		$('.cb-enable span').find().attr('unselectable', 'on');
	}

	/**
	 * Media Uploader
	 * Dependencies 	 : jquery, wp media uploader
	 * Feature added by : Smartik - http://smartik.ws/
	 * Date 			 : 05.28.2013
	 */
	function getweb_options_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this),
			fileType = $el.data('file-type');

		event.preventDefault();
		if ( frame ) {
			frame.open();
			return;
		}

		var args = {
			title: $el.data('choose'),
			button: {
				text: $el.data('update'),
				close: false
			}
		};

		if( fileType ) {
			args.library = {
				type: fileType
			}
		}

		frame = wp.media(args);

		frame.on( 'select', function() {
			var attachment = frame.state().get('selection').first();
			frame.close();
			selector.find('.upload').val(attachment.attributes.url);
			if ( attachment.attributes.type == 'image' ) {
				selector.find('.screenshot').empty().hide().append('<img class="of-option-image" src="' + attachment.attributes.url + '">').slideDown('fast');
			}
			selector.find('.media_upload_button').unbind();
			selector.find('.remove-image').removeClass('hide');//show "Remove" button
			selector.find('.of-background-properties').slideDown();
			getweb_options_file_bindings();
		});

		frame.open();
	}

	function getweb_options_remove_file(selector) {
		selector.find('.remove-image').addClass('hide');
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind();
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.media_upload_button').remove();
		}
		getweb_options_file_bindings();
	}

	function getweb_options_file_bindings() {
		$('.remove-image, .remove-file').on('click', function() {
			getweb_options_remove_file( $(this).parents('.section-upload, .section-media, .media-wrap') );
		});

		$('.media_upload_button').unbind('click').click( function( event ) {
			getweb_options_add_file(event, $(this).parents('.section-upload, .section-media, .media-wrap'));
		});
	}

	getweb_options_file_bindings();
	/**
	 * Switch
	 * Dependencies 	 : jquery
	 * Feature added by : Smartik - http://smartik.ws/
	 * Date 			 : 03.17.2013
	 */
	jQuery(".switch-options label").click(function(){
		var $switchVal = $(this).data('id'),
			$hiddenInput = $(this).parent('.switch-options').find('.pix-switch-value');
		$(this).addClass('selected').siblings('label').removeClass('selected');
		$hiddenInput.val($switchVal);


	});
	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if (($.browser.msie && $.browser.version < 10) || $.browser.opera) {
		$('.cb-enable span').find().attr('unselectable', 'on');
	}
});

