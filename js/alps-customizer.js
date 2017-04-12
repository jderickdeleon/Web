function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function() {
        var button_id ='#'+jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment){

            if ( _custom_media  ) {
                if(typeof display_field !== 'undefined'){
                    switch(props.size){
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        case 'customizer_team':
                            display_field.val(attachment.sizes.customizer_team.url);
                            display_field.trigger('change');
                            break;
                        case 'customizer_services':
                            display_field.val(attachment.sizes.customizer_services.url);
                            display_field.trigger('change');
                            break;
                        case 'customizer_customers':
                            display_field.val(attachment.sizes.customizer_customers.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment( button_id, [props, attachment] );
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function() {

        };
        return false;
    });
}

/********************************************
 *** Generate uniq id ***
 *********************************************/
function customizer_uniqid(prefix, more_entropy) {

    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var formatSeed = function(seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return Array(1 + (reqWidth - seed.length))
                    .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!this.php_js) {
        this.php_js = {};
    }
    // END REDUNDANT
    if (!this.php_js.uniqidSeed) { // init seed with big random int
        this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    this.php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
            .getTime() / 1000, 10), 8);
    retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}


/********************************************
 *** General Repeater ***
 *********************************************/
function customizer_refresh_social_icons(th){
    'use strict';
    var icons_repeater_values = [];
    th.find('.customizer-social-repeater-container').each(function(){
        var icon = jQuery(this).find('.icp').val();
        var link = jQuery(this).find('.customizer_social_repeater_link').val();
        var id = jQuery(this).find('.customizer_social_repeater_id').val();

        if( !id ){
            id = 'customizer_social_repeater_' + customizer_uniqid();
            jQuery(this).find('.customizer_social_repeater_id').val(id);
        }

        if( icon !== ''){
            icons_repeater_values.push({
                'icon':icon,
                'link':link,
                'id':id
            });
        }
    });

    th.find('.customizer_socials_repeater_colector').val(JSON.stringify(icons_repeater_values));
    customizer_refresh_general_control_values();
}



function customizer_refresh_general_control_values(){
    'use strict';
    jQuery('.customizer_general_control_repeater').each(function(){
        var values = [];
        var th = jQuery(this);
        th.find('.customizer_general_control_repeater_container').each(function(){
            var icon_value = jQuery(this).find('.icp').val();
            var text = jQuery(this).find('.customizer_text_control').val();
            var link = jQuery(this).find('.customizer_link_control').val();
            var image_url = jQuery(this).find('.custom_media_url').val();
            var choice = jQuery(this).find('.customizer_image_choice').val();
            var title = jQuery(this).find('.customizer_title_control').val();
            var subtitle = jQuery(this).find('.customizer_subtitle_control').val();
            var id = jQuery(this).find('.customizer_box_id').val();
            if( !id ){
                id = 'customizer_' + customizer_uniqid();
                jQuery(this).find('.customizer_box_id').val(id);
            }
            var social_repeater = jQuery(this).find('.customizer_socials_repeater_colector').val();
            var shortcode = jQuery(this).find('.customizer_shortcode_control').val();

            if( text !== '' || image_url!== '' || title!=='' || subtitle!=='' ){
                values.push({
                    'icon_value' : (choice === 'parallax_none' ? '' : icon_value) ,
                    'text' :  escapeHtml(text),
                    'link' : link,
                    'image_url' : (choice === 'parallax_none' ? '' : image_url),
                    'choice' : choice,
                    'title' : escapeHtml(title),
                    'subtitle' : escapeHtml(subtitle),
                    'social_repeater' : escapeHtml(social_repeater),
                    'id' : id,
                    'shortcode' : escapeHtml(shortcode)
                });
            }

        });
        th.find('.customizer_repeater_colector').val(JSON.stringify(values));
        th.find('.customizer_repeater_colector').trigger('change');
    });
}



jQuery(document).ready(function(){
    'use strict';
    jQuery('#customize-theme-controls').on('click','.customizer-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible')){
                jQuery(this).css('display','block');
            }
        });
    });

    jQuery('#customize-theme-controls').on('change', '.icp',function(){
        customizer_refresh_general_control_values();
        return false;
    });

    jQuery('#customize-theme-controls').on('change','.customizer_image_choice',function() {
        if(jQuery(this).val() === 'parallax_image'){
            jQuery(this).parent().parent().find('.customizer_general_control_icon').hide();
            jQuery(this).parent().parent().find('.customizer_image_control').show();
        }
        if(jQuery(this).val() === 'parallax_icon'){
            jQuery(this).parent().parent().find('.customizer_general_control_icon').show();
            jQuery(this).parent().parent().find('.customizer_image_control').hide();
        }
        if(jQuery(this).val() === 'parallax_none'){
            jQuery(this).parent().parent().find('.customizer_general_control_icon').hide();
            jQuery(this).parent().parent().find('.customizer_image_control').hide();
        }

        customizer_refresh_general_control_values();
        return false;
    });
    media_upload('.custom_media_button_customizer');
    jQuery('.custom_media_url').live('change',function(){
        customizer_refresh_general_control_values();
        return false;
    });

    /**
     * This adds a new box to repeater
     *
     */
    jQuery('#customize-theme-controls').on('click', '.customizer_general_control_new_field', function() {
        var th = jQuery(this).parent();
        var id = 'customizer_' + customizer_uniqid();
        if( typeof th !== 'undefined' ) {
            /* Clone the first box*/
            var field = th.find('.customizer_general_control_repeater_container:first').clone();

            if( typeof field !== 'undefined' ){
                /*Set the default value for choice between image and icon to icon*/
                field.find('.customizer_image_choice').val('customizer_icon');

                /*Show icon selector*/
                field.find('.customizer_general_control_icon').show();

                /*Hide image selector*/
                if(field.find('.customizer_general_control_icon').length > 0){
                    field.find('.customizer_image_control').hide();
                }

                /*Show delete box button because it's not the first box*/
                field.find('.customizer_general_control_remove_field').show();

                field.find('.icp').iconpicker().on('iconpickerUpdated', function () {
                    jQuery(this).trigger('change');
                });

                field.find('.input-group-addon span').attr('class','');

                /*Remove all repeater fields except first one*/
                field.find('.customizer-social-repeater').find('.customizer-social-repeater-container').not(':first').remove();
                field.find('.customizer_social_repeater_link').val('');
                field.find('.customizer_socials_repeater_colector').val('');


                field.find('.iconpicker-component').html('');
                field.find('.icp').val('');
                /*Remove value from text field*/
                field.find('.customizer_text_control').val('');

                /*Remove value from link field*/
                field.find('.customizer_link_control').val('');

                /*Set box id*/
                field.find('.customizer_box_id').val(id);

                /*Remove value from media field*/
                field.find('.custom_media_url').val('');

                /*Remove value from title field*/
                field.find('.customizer_title_control').val('');

                /*Remove value from subtitle field*/
                field.find('.customizer_subtitle_control').val('');

                /*Remove value from shortcode field*/
                field.find('.customizer_shortcode_control').val('');

                /*Append new box*/
                th.find('.customizer_general_control_repeater_container:first').parent().append(field);

                /*Refresh values*/
                customizer_refresh_general_control_values();
            }

        }
        return false;
    });



    jQuery('#customize-theme-controls').on('click', '.customizer_general_control_remove_field',function(){
        if( typeof	jQuery(this).parent() !== 'undefined'){
            jQuery(this).parent().parent().remove();
            customizer_refresh_general_control_values();
        }
        return false;
    });


    jQuery('#customize-theme-controls').on('keyup', '.customizer_title_control',function(){
        customizer_refresh_general_control_values();
    });

    jQuery('#customize-theme-controls').on('keyup', '.customizer_subtitle_control',function(){
        customizer_refresh_general_control_values();
    });

    jQuery('#customize-theme-controls').on('keyup', '.customizer_shortcode_control',function(){
        customizer_refresh_general_control_values();
    });

    jQuery('#customize-theme-controls').on('keyup', '.customizer_text_control',function(){
        customizer_refresh_general_control_values();
    });

    jQuery('#customize-theme-controls').on('keyup', '.customizer_link_control',function(){
        customizer_refresh_general_control_values();
    });

    /*Drag and drop to change icons order*/

    jQuery('.customizer_general_control_droppable').sortable({
        update: function() {
            customizer_refresh_general_control_values();
        }
    });



    /*----------------- Socials Repeater ---------------------*/
    jQuery('#customize-theme-controls').on('click','.customizer_add_social_item', function( event ){
        event.preventDefault();
        var th = jQuery(this).parent();
        var id = 'customizer_social_repeater_' + customizer_uniqid();
        if(typeof th !== 'undefined') {
            var field = th.find('.customizer-social-repeater-container:first').clone();
            if(typeof field !== 'undefined'){
                field.find( '.icp' ).iconpicker();
                field.find( '.icp' ).val('');
                field.find( '.input-group-addon' ).find('span').attr('class','');
                field.find('.customizer_remove_social_item').show();
                field.find('.customizer_social_repeater_link').val('');
                field.find('.customizer_social_repeater_id').val(id);
                th.find('.customizer-social-repeater-container:first').parent().append(field);
                customizer_refresh_social_icons(th);
            }
        }
        return false;
    });

    jQuery('#customize-theme-controls').on('click','.customizer_remove_social_item', function( event ){
        event.preventDefault();
        var th = jQuery(this).parent();
        var repeater = jQuery(this).parent().parent();
        th.remove();
        customizer_refresh_social_icons(repeater);
        return false;
    });

    jQuery('#customize-theme-controls').on('keyup','.customizer_social_repeater_link', function( event ){
        event.preventDefault();
        var repeater = jQuery(this).parent().parent();
        customizer_refresh_social_icons(repeater);
        return false;
    });

    jQuery('#customize-theme-controls').on( 'iconpickerUpdated','.icp', function(event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent().parent();
        customizer_refresh_social_icons(repeater);
        return false;
    } );

});

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;',
};

function escapeHtml(string) {
    'use strict';
    string = String(string).replace(new RegExp('\r?\n','g'), '<br />');
    string = String(string).replace(/\\/g,'&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });

}
/********************************************
 *** Parallax effect
 *********************************************/

jQuery(document).ready(function(){

    'use strict';
    var sh = jQuery('#customize-control-paralax_one_enable_move').find('input:checkbox');
    if(!sh.is(':checked')){
        jQuery('#customize-control-paralax_one_first_layer').hide();
        jQuery('#customize-control-paralax_one_second_layer').hide();
        jQuery('#customize-control-header_image').show();
    } else {
        jQuery('#customize-control-paralax_one_first_layer').show();
        jQuery('#customize-control-paralax_one_second_layer').show();
        jQuery('#customize-control-header_image').hide();
    }

    sh.on('change',function(){
        if(jQuery(this).is(':checked')){
            jQuery('#customize-control-paralax_one_first_layer').fadeIn();
            jQuery('#customize-control-paralax_one_second_layer').fadeIn();
            jQuery('#customize-control-header_image').fadeOut();
        } else {
            jQuery('#customize-control-paralax_one_first_layer').fadeOut();
            jQuery('#customize-control-paralax_one_second_layer').fadeOut();
            jQuery('#customize-control-header_image').fadeIn();
        }
    });
});


/********************************************
 *** Alpha Opacity
 *********************************************/

jQuery(document).ready(function($) {
    'use strict';
    Color.prototype.toString = function(remove_alpha) {
        if (remove_alpha === 'no-alpha') {
            return this.toCSS('rgba', '1').replace(/\s+/g, '');
        }
        if (this._alpha < 1) {
            return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
        }
        var hex = parseInt(this._color, 10).toString(16);
        if (this.error) {
            return '';
        }
        if (hex.length < 6) {
            for (var i = 6 - hex.length - 1; i >= 0; i--) {
                hex = '0' + hex;
            }
        }
        return '#' + hex;
    };

    $('.pluto-color-control').each(function() {
        var $control = $(this),
            value = $control.val().replace(/\s+/g, ''),
            palette;
        // Manage Palettes
        var palette_input = $control.attr('data-palette');
        if (palette_input === 'false' || palette_input === false) {
            palette = false;
        } else if (palette_input === 'true' || palette_input === true) {
            palette = true;
        } else {
            palette = $control.attr('data-palette').split(',');
        }
        $control.wpColorPicker({ // change some things with the color picker
            clear: function() {
                // TODO reset Alpha Slider to 100
            },
            change: function(event, ui) {
                // send ajax request to wp.customizer to enable Save & Publish button
                var _new_value;
                if(typeof ui.color !== 'undefined'){
                    _new_value = ui.color.toString();
                } else {
                    _new_value = $control.val();
                }
                var key = $control.attr('data-customize-setting-link');
                wp.customize(key, function(obj) {
                    obj.set(_new_value);
                });
                // change the background color of our transparency container whenever a color is updated
                var $transparency = $control.parents('.wp-picker-container:first').find('.transparency');
                // we only want to show the color at 100% alpha
                $transparency.css('backgroundColor', ui.color.toString('no-alpha'));
            },
            palettes: palette // remove the color palettes
        });
        $('<div class="customizer-alpha-container"><div class="slider-alpha"></div><div class="transparency"></div></div>').appendTo($control.parents('.wp-picker-container'));
        var $alpha_slider = $control.parents('.wp-picker-container:first').find('.slider-alpha'),
            alpha_val;
        // if in format RGBA - grab A channel value
        if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
            alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
            alpha_val = parseInt(alpha_val);
        } else {
            alpha_val = 100;
        }
        $alpha_slider.slider({
            slide: function(event, ui) {
                $(this).find('.ui-slider-handle').text(ui.value); // show value on slider handle
                // send ajax request to wp.customizer to enable Save & Publish button
                var _new_value = $control.val();
                var key = $control.attr('data-customize-setting-link');
                wp.customize(key, function(obj) {
                    obj.set(_new_value);
                });
            },
            create: function() {
                var v = $(this).slider('value');
                $(this).find('.ui-slider-handle').text(v);
            },
            value: alpha_val,
            range: 'max',
            step: 1,
            min: 1,
            max: 100
        }); // slider
        $alpha_slider.slider().on('slidechange', function(event, ui) {
            var new_alpha_val = parseFloat(ui.value),
                iris = $control.data('a8cIris'),
                color_picker = $control.data('wpWpColorPicker');
            iris._color._alpha = new_alpha_val / 100.0;
            $control.val(iris._color.toString());
            color_picker.toggler.css({
                backgroundColor: $control.val()
            });
            // fix relationship between alpha slider and the 'side slider not updating.
            var get_val = $control.val();
            $($control).wpColorPicker('color', get_val);
        });
    });


});
