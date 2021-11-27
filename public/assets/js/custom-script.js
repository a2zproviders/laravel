const baseUrl = $('base').attr('href');
$(function() {
    setTimeout(function() {
        $('.toast-msg').fadeOut();
    }, 3000);

    $('.select2').select2();

    var salePrice = 0;
    var rp = 0;

    $('#discount').on('keyup', function() {
        const ds = $(this).val();
        // if (rp == 0 && rp == '') {
        //     $("#regular_price").focus();
        //     $(this).val(0);
        // }
        if (ds == '') $(this).val(0).select();
        rp = $("#regular_price").val();
        salePrice = rp - (rp * ds / 100);
        $("#sale_price").val(salePrice);
    });
    $('#sale_price').on('keyup', function() {
        const sp = $(this).val();
        // if (rp == 0 && rp == '') $("#regular_price").focus();
        if (sp == '') $(this).val(0).select();
        rp = $("#regular_price").val();
        salePrice = (rp - sp) * 100 / rp;
        $("#discount").val(salePrice);
    });

    var src = '';
    var id = '';
    $(document).on('click', ".add_media", function() {
        let idTarget = srcTarget = '';
        if (typeof $(this).data('id-target') !== 'undefined') {
            idTarget = $(this).data('id-target');
        }
        if (typeof $(this).data('src-target') !== 'undefined') {
            srcTarget = $(this).data('src-target');
        }
        $('#mediaImageId').val(idTarget);
        $('#mediaImageSrc').val(srcTarget);
        $("#upload_media").modal('show');
    });

    $(document).on('click', '.select_image', function() {
        $(".select_image").css({
            'border': 'none',
            'opacity': 1
        });
        $(this).css({
            'border': '2px solid green',
            'opacity': .7
        });
        src = $(this).attr('src');
        id  = $(this).data('id');
        $('#editorImageId').val(id);
        $('#editorImageSrc').val(src);
    });

    $(document).on("click", ".addImageBtn", function() {
        let img_count = $('#imageCount').val() + 1;
        $('#imageCount').val(img_count);

        let html = `
          <div class="col-3 col-sm-2 mt-2 image_box">
               <div>
               
               <button type="button" class="btn btn-link btn-block btn-sm text-dark removeImageBtn"><i class="fas fa-times"></i> Remove</button>
                  <img
                      src="${baseUrl}/top.jpg"
                      class="add_media" id="show_image_${img_count}"
                      style="width: 100%; height:100px; object-fit: cover; border-radius: 8px;"
                      data-id-target="#image_${img_count}"
                      data-src-target="#show_image_${img_count}"
                  />
                  <input
                      type="hidden"
                      name="menu_image[]"
                      id="image_${img_count}"
                  />
               </div>
           </div>
        `;
        $('#menuImageBox').append( html );
    });
    
    $(document).on('click', "#okay_media", function() {
        let mediaImageId = $('#mediaImageId').val(),
            mediaImageSrc = $('#mediaImageSrc').val();
            // alert(mediaImageId);

        mediaImageId = mediaImageId != '' ? mediaImageId : '#image';
        mediaImageSrc = mediaImageSrc != '' ? mediaImageSrc : '#show_image';

        $("#upload_media").modal('hide');
        $(mediaImageId).val(id);
        $(mediaImageSrc).attr('src', src);
    });
    
    $(document).on("click", ".removeImageBtn", function() {
        $(this).closest(".image_box").remove();
    });

    $(document).on("click", ".removeMenuImage", function() {
        let self = $(this),
            id   = self.data("id");

        $.ajax({
            url: baseUrl+"/restaurent-control/menu/remove_image/"+id,
            success: function( res ) {
                self.closest(".image_box").remove();
            }
        });
    });
    
    
    
    $(document).on('click', "#first_modal", function() {
        $("#modal-first").modal('show');
    });
    
});

Dropzone.options.dropzone = {
    url: baseUrl + '/restaurent-control/media/add',
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    maxFilesize: 12,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: false,
    timeout: 5000,
    success: function(file, response) {
        $(".image_group").first().prepend('<img src="' + response.name + '" alt="" class="select_image" data-id="' + response.id + '" style="width: 120px; height: 120px; object-fit: cover;" />');
    },
    error: function(file, response) {
        return false;
    }
};
// Editor TinyMCE
    tinymce.init({
        selector: '.editor',
        plugins: "code, link, image, textcolor, emoticons, hr, lists, charmap, table",
        fontsizeselect: true,
        browser_spellcheck: true,
        menubar: false,
        toolbar: 'bold italic underline strikethrough | formatselect h1 h2 h3 h4 h5 h6 | table hr superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | uploadImageButton | code',
        branding: false,
        protect: [
            /\<\/?(if|endif)\>/g, // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g, // Protect <xsl:...>
            /\<script\:[^>]+\>/g, // Protect <xsl:...>
            /<\?php.*?\?>/g // Protect php code
        ],
        images_upload_credentials: true,
        file_browser_callback_types: 'image',
        image_dimensions: true,
        automatic_uploads: true,
        relative_urls: false,
        remove_script_host: false,
        setup: function(editor) {
            editor.ui.registry.addButton('uploadImageButton', {
                icon: 'image',
                onAction: function() {
                    $('#upload_media1').modal('show');
                }
            });
        }
    });
    
    $(function() {
        $(document).on('click', "#okay_media1", function() {
            let parent1  = $(this).closest('.modal-body').find('#mediaImageId1').val(),
                parent  = $(this).closest('.modal-content'),
                img_src = parent.find('input[type=radio]:checked').data('src'),
                id      = parent.find('input[type=radio]:checked').val();

            let editorImageId = $('#editorImageId').val(),
                editorImageSrc = $('#editorImageSrc').val();
                editorImageAlt = $('#editorImageAlt').val();
                editorImageTitle = $('#editorImageTitle').val();
            let mediaImageId = $('#mediaImageId').val(),
                mediaImageSrc = $('#mediaImageSrc').val();
            
            if(editorImageId == '' && editorImageSrc == '') {
                let content = '<img src="' + img_src + '" class="editor-image" width="100%">';
                tinymce.activeEditor.execCommand('mceInsertContent', false, content);
            } else {
                editorImageId = editorImageId != '' ? editorImageId : '#image';
                editorImageSrc = editorImageSrc != '' ? editorImageSrc : '#show_image';

                $(mediaImageId).val(editorImageId);
                $(mediaImageSrc).attr('src', editorImageSrc);

                let content = '<img src="' + editorImageSrc + '" class="editor-image" alt="' + editorImageAlt + '" title="' + editorImageTitle + '" width="100%">';
                tinymce.activeEditor.execCommand('mceInsertContent', false, content);

                $("#upload_media1").modal('hide');
            }
        }); 
        
    });
    
    /*
    $(document).on('click', '.mediaDoneBtn', function() {
        let parent  = $(this).closest('.modal-content'),
            img_src = parent.find('input[type=radio]:checked').data('src'),
            id      = parent.find('input[type=radio]:checked').val();

        let inpField = $('#mediaFeild').val(),
            srcField = $('#mediaSrcFeild').val();

        if(inpField == '' && srcField == '') {
            let content = '<img src="' + img_src + '" class="editor-image">';
            tinymce.activeEditor.execCommand('mceInsertContent', false, content);
        } else {
            $(inpField).val(id);
            $(srcField).attr('src', img_src);
        }

        $('#mediaModal').modal('hide');
    });
    */
    
    
