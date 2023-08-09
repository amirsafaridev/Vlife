

jQuery(document).ready(function () {
    //open wordpress image box uploader and when user select an item change img tag src to selected image url
    jQuery('.arta_upload_file').on('click', function(e){
        e.preventDefault();
        var parent = jQuery(this).parent()
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Add Promotion image',
            button: {
                text: 'Add Promotion image'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            console.log("selected")
            console.log(attachment)
            parent.children("img").attr('src', attachment.url);
            parent.children("input").val( attachment.id);
        });
        custom_uploader.open();
    });

    //when click on new button clone new box from sample
    jQuery('#arta_add_new_promotion').click(function () {
        console.log('click new')
        jQuery("#arta_main_prom_box_sample .arta_main_prom_box:first").clone().attr("data-id","new").prependTo(".arta_prom_container");
        //open wordpress image box uploader and when user select an item change img tag src to selected image url

        jQuery('.arta_upload_file').on('click', function(e){
            e.preventDefault();
            var parent = jQuery(this).parent()
            var custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Add Promotion image',
                button: {
                    text: 'Add Promotion image'
                },
                multiple: false
            });
            custom_uploader.on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                console.log("selected")
                console.log(attachment)
                parent.children("img").attr('src', attachment.url);
                parent.children("input").val( attachment.id);
            });
            custom_uploader.open();
        });
        //when click on delete button
        jQuery('.arta_delete_prom').click(function () {


            selectedelm = this
            var parent = jQuery(selectedelm).parent()
            if (parent.attr('data-id') == "new"){
                jQuery(parent).remove();
            }
            else {
                data = {
                    "parent" : arta_vlife_promotion_object.post.ID,
                    "id" : parent.attr('data-id'),
                }
                jQuery.ajax({
                    type: 'post',
                    url: arta_vlife_promotion_object.ajaxurl,
                    data: {
                        "action": 'arta_vlife_promotion_delete_ajax',
                        "data" : data,
                    },
                    beforeSend: function () {
                        jQuery('#arta_add_save_promotion').prop('disabled', true);
                        jQuery('#arta_add_save_promotion').text("Waite... ");
                        jQuery(selectedelm).text("Deleting... ");

                    },
                    success: function (data) {
                        setTimeout(function () {
                            jQuery(parent).remove();
                        },2000)
                    },
                    complete: function () {

                    }
                });
            }





        });
    });

    //when click on save button
    jQuery('#arta_add_save_promotion').click(function () {
        var item_count = jQuery(".arta_prom_container .arta_main_prom_box").length;
        var counter = 0;
        jQuery(".arta_prom_container .arta_main_prom_box").each(function (index,item) {

            selectedelm = this
            data = {
                "parent" : arta_vlife_promotion_object.post.ID,
                "id" : jQuery(selectedelm).attr('data-id'),
                "img_id" : jQuery(selectedelm).children('.col1').children('input[name="promotion_img_id"]').val(),
                "header" : jQuery(selectedelm).children('.col2').children('input[name="header"]').val(),
                "body" :  jQuery(selectedelm).children('.col2').children('textarea').val(),
                "from" : jQuery(selectedelm).children('.col2').children('input[name="from"]').val(),
                "to" :   jQuery(selectedelm).children('.col2').children('input[name="to"]').val(),
                "cta" :   jQuery(selectedelm).children('.col3').children('input[name="cta"]').val(),
                "link" : jQuery(selectedelm).children('.col3').children('input[name="link"]').val(),
            }
            jQuery.ajax({
                type: 'post',
                url: arta_vlife_promotion_object.ajaxurl,
                data: {
                    "action": 'arta_vlife_promotion_save_ajax',
                    "data" : data,
                },
                beforeSend: function () {
                    jQuery('#arta_add_save_promotion').prop('disabled', true);
                    jQuery('#arta_add_save_promotion').text("Waite... ");
                },
                success: function (data) {
                    counter = counter +1;
                    if (counter == item_count){
                        jQuery(".arta_prom_general_msg").html("Done !")
                        jQuery('#arta_add_save_promotion').prop('disabled', false);
                        jQuery('#arta_add_save_promotion').text("Save");
                        setTimeout(function () {
                            jQuery(".arta_prom_general_msg").html("")
                        },5000)
                    }
                    data = JSON.parse(data)
                    jQuery(selectedelm).children('.msg').html(data.msg)
                    setTimeout(function () {
                        jQuery(selectedelm).children('.msg').html("")
                    },5000)
                    jQuery(selectedelm).attr('data-id',data.post_id)
                },
                complete: function () {

                }
            });


        })

    });

    //when click on delete button
    jQuery('.arta_delete_prom').click(function () {


            selectedelm = this
            var parent = jQuery(selectedelm).parent()
           if (parent.attr('data-id') == "new"){
               jQuery(parent).remove();
           }
           else {
               data = {
                   "parent" : arta_vlife_promotion_object.post.ID,
                   "id" : parent.attr('data-id'),
               }
               jQuery.ajax({
                   type: 'post',
                   url: arta_vlife_promotion_object.ajaxurl,
                   data: {
                       "action": 'arta_vlife_promotion_delete_ajax',
                       "data" : data,
                   },
                   beforeSend: function () {
                       jQuery('#arta_add_save_promotion').prop('disabled', true);
                       jQuery('#arta_add_save_promotion').text("Waite... ");
                       jQuery(selectedelm).text("Deleting... ");

                   },
                   success: function (data) {
                       setTimeout(function () {
                           jQuery('#arta_add_save_promotion').prop('disabled', false);
                           jQuery('#arta_add_save_promotion').text("Save");
                           jQuery(parent).remove();
                       },2000)
                   },
                   complete: function () {

                   }
               });
           }





    });
    jQuery(".art_prom_item_v_all img").each(function (index,item) {
        jQuery(this).css("height",jQuery(this).width())

    });


});

function sortpromotion(element) {
    jQuery(element).parent().submit();
}