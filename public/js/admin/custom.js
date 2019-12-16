//DataTables
$(document).ready( function () {
    $('#table_id').DataTable();
} );
$('#example').DataTable( {
    paging: false
} );
$('#example').DataTable( {
    scrollY: 400
} );

// For this specific table we are going to enable ordering
// (searching is still disabled)
$('#example').DataTable( {
    ordering: true,
    searching: true
} );

$(document).on('click','.delete_btn',function(e){
    e.preventDefault();
    Swal.fire({
        title: 'Вы уверены?',
        text: "Действие невозможно отменить!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить!',
        cancelButtonText: 'Отмена'
    }).then((result) => {
        if (result.value) {
            Swal.fire(
                'Удалено!',
                'Данные удалены.',
                'success'
            )
            $(this).find("form").submit();
        }
    })
});


$(document).on('click', "#allow_category", function (e) {
    var categorySelect = document.getElementById("category_select");

    if (e.target.checked) {
        categorySelect.disabled = false;
    } else {
        categorySelect.disabled = true;
    }
})

$(document).on('click', "#allow_brand", function (e) {
    var brandSelect = document.getElementById("brand_select");

    if (e.target.checked) {
        brandSelect.disabled = false;
    } else {
        brandSelect.disabled = true;
    }
})

$(document).on('click', "#allow_product", function (e) {
    var productSelect = document.getElementById("product_select");

    if (e.target.checked) {
        productSelect.disabled = false;
    } else {
        productSelect.disabled = true;
    }
})







$(window).load(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

var images = [];
$(document).on('change','.form_element input[type=file]',function(e){
    var files = $(".create_product").find("#files")[0].files;
    for (var image of files){
        if (!images.find(obj => obj.name === image.name)){
            // images.push(image);
            $.hieraModal({
                "content": create_cropper(URL.createObjectURL(image))
            });
            start_cropper()
        }
    }
    console.log(images);
    // var data = new FormData();
    // data.append("name", $(".create_product").find("#name").val());
    // data.append("description", $(".create_product").find("#description").val());
    // data.append("price", $(".create_product").find("#price").val());
    // data.append("price_discount", $(".create_product").find("#price_discount").val());
    // data.append("quantity", $(".create_product").find("#quantity").val());
    // data.append("is_popular", $(".create_product").find("#is_popular").is(':checked'));
    // data.append("category", $(".create_product").find("#category :selected").val());
    // data.append("brand", $(".create_product").find("#brand :selected").val());
});

function create_cropper(img){
    console.log(img);
    var croper_html = $('<div/>', {
        'class':  'cropper',
        'id': 'custom_cropper'
    });
    var cropper_img_wrap = $('<div/>', {
        'class':  'cropper-img'
    }).prependTo(croper_html);
    var cropper_img = $('<img/>', {
        'class':  'img-responsive',
        'id': 'cropper-img',
        'src': img
    }).prependTo(cropper_img_wrap);


    var cropper_toolbar = $('<div/>', {
        'class':  'cropper-toolbar'
    }).prependTo(croper_html);

    $('<button/>', {
        'class':  'btn btn-link link-muted hidden-xs',
        'data-option': 'move',
        'data-toggle': 'Повернуть на 90° по часовой',
        'data-animation': 'false',
        'data-method': 'setDragMode',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-arrows icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted hidden-xs',
        'data-option': 'crop',
        'data-method': 'setDragMode',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-crop icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '0.1',
        'data-method': 'zoom',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-search-plus icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '-0.1',
        'data-method': 'zoom',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-search-minus icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '-45',
        'data-method': 'rotate',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-rotate-left icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '45',
        'data-method': 'rotate',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-rotate-right icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '-1',
        'data-method': 'scaleX',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-arrows-h icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '-1',
        'data-method': 'scaleY',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-arrows-v icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted',
        'data-option': '-1',
        'data-method': 'crop',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-check icon-lg'
    })).appendTo(cropper_toolbar);

    $('<button/>', {
        'class':  'btn btn-link link-muted destroy-btn',
        'type': 'button'
    }).append($('<span/>', {
        'class':  'icon icon-times '
    })).appendTo(cropper_toolbar);
    return croper_html;
}



function start_cropper() {
    'use strict';

    var console = window.console || {
        log: function () {
        }
    };
    var URL = window.URL || window.webkitURL;
    var $image = $('#cropper-img');
    var uploadedImageURL;
    var options = {
        aspectRatio: 1 / 1,
        viewMode: 3,
        minWidth: 300,
        responsive: true
    };

    // Cropper
    $image.cropper(options);

    // Methods
    $('.cropper-toolbar').on('click', '[data-method]', function () {
        var $this = $(this);
        var data = $this.data();
        var cropper = $image.data('cropper');
        var cropped;
        var $target;
        var result;

        if ($this.prop('disabled') || $this.hasClass('disabled')) {
            return;
        }

        if (cropper && data.method) {
            data = $.extend({}, data); // Clone a new one
            if (typeof data.target !== 'undefined') {
                $target = $(data.target);
                if (typeof data.option === 'undefined') {
                    try {
                        data.option = JSON.parse($target.val());
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }

            cropped = cropper.cropped;

            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        $image.cropper('clear');
                    }

                    break;

                case 'getCroppedCanvas':
                    if (uploadedImageType === 'image/jpeg') {
                        if (!data.option) {
                            data.option = {};
                        }
                        data.option.fillColor = '#fff';
                    }
                    break;
            }

            result = $image.cropper(data.method, data.option, data.secondOption);

            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        $image.cropper('crop');
                    }
                    break;

                case 'scaleX':
                case 'scaleY':
                    $(this).data('option', -data.option);
                    break;

                case 'getCroppedCanvas':
                    if (result) {
                        $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
                        alert(result);
                        if (!$download.hasClass('disabled')) {
                            download.download = uploadedImageName;
                            $download.attr('href', result.toDataURL(uploadedImageType));
                        }
                    }

                    break;

                case 'destroy':
                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                        uploadedImageURL = '';
                        $image.attr('src', originalImageURL);
                    }
                    break;
            }

            if ($.isPlainObject(result) && $target) {
                try {
                    $target.val(JSON.stringify(result));
                } catch (e) {
                    console.log(e.message);
                }
            }

        }
    });
}
