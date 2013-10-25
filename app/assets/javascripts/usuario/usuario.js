$(document).ready(function() {

    $(".fechaN").datetimepicker({
        language: 'es',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: 'yyyy-mm-dd',
        pickerPosition: "top-right"
    });

    $('#selEstado').change(function() {
        var ciudades = "";
        $("#selCiudad").html("");
        $.post($(this).attr('site'), {estado: $(this).val()}, function(o) {
            $.each(o, function(index, data) {
                ciudades += '<option value="' + data.id + '">' + data.nombre + '</option>';
            });
            $("#selCiudad").append(ciudades);
        }, 'json');
    });

    $("#btnPersonal").click(function(e) {
        e.preventDefault();
        $.post($(this).parents('form').attr('action'), $(this).parents('form').serialize(), function(o) {
            if (o.exito) {

            } else {
                $(".error").html(o.msg).removeClass('hidden');
                setTimeout(function() {
                    $(".error").fadeOut(1000, function() {
                        $(".error").addClass('hidden');
                    });
                }, 5000);
            }

        }, 'json');
    });
    
    $(".panel-primary").on('click','#btnPerfil',function(e) {
        e.preventDefault();
        $.post($(this).parents('form').attr('action'), $(this).parents('form').serialize(), function(o) {
            if (o.exito) {
                $("#perfilList").load($('#frmPerfil').attr('action')+' #perfilList');
            } else {
                $(".error").html(o.msg).removeClass('hidden');
                setTimeout(function() {
                    $(".error").fadeOut(1000, function() {
                        $(".error").addClass('hidden');
                    });
                }, 5000);
            }

        }, 'json');
    });
    
    $('#perfilList').on('click','.deletePerfil',function(){
        $.post('')
        alert($(this).parent('li').data('id'));
    });

});

/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function() {

    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'http://laravel/' ?
            '//jquery-file-upload.appspot.com/' : $("#foto").attr('url'),
            uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function() {
        var $this = $(this),
                data = $this.data();
        $this
                .off('click')
                .text('Abort')
                .on('click', function() {
            $this.remove();
            data.abort();
        });
        data.submit().always(function() {
            $this.remove();
        });
    });

    $('#foto').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 512000, // 500 Kb
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function(e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function(index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                        .append('<br>')
                        .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function(e, data) {
        var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
        if (file.preview) {
            node
                    .prepend('<br>')
                    .prepend(file.preview);
        }
        if (file.error) {
            node
                    .append('<br>')
                    .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                    .text('Upload')
                    .prop('disabled', !!data.files.error);
        }

    }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
                'width',
                progress + '%'
                );
    }).on('fileuploaddone', function(e,data) {            
    if (data.result.exito===true) {
            $('#txtIdFoto').attr('value', data.result.id);            
        }

    }).on('fileuploadfail', function(e, data) {
        $.each(data.files, function(index, file) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});