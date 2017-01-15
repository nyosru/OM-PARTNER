(function ($) {
    $.fn.imageUpload = function (url, options) {
        if (url) {
            var settings = $.extend({
                uploadButtonText: 'Загрузить',
                previewImageSize: 100,
                maxImageCount: 1,
                img_tpl: '<img>',
                onSuccess: function (response) {

                }
            }, options);

            return this.each(function () {
                $(this).html('\
					<div id="img-container">\
					 	<ul id="img-list" style="padding-left: 0;"/>\
					</div>\
                    <div class="progress">\
                        <div class="progress-bar progress-bar-striped active" role="progressbar"\
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">\
                        </div>\
                    </div>\
					<button type="button" id="upload-images">' + settings.uploadButtonText + '</button>\
				');

                var imgList = $('ul#img-list');
                imgList.displayFilesInputCount(settings.maxImageCount, settings.img_tpl);
                var fileInput = $('.file-field');
                var dropBox = $('.img-dropBox-container');
                var uploadButton = $('#upload-images');
                var uploadStatus = $('.progress-bar');

                fileInput.bind({
                    change: function (e) {
                        $(e.target).closest('li').displayImg(this.files, settings.previewImageSize);
                    }
                });

                dropBox.bind({
                    dragenter: function (e) {
                        $(this).addClass('highlighted');
                        return false;
                    },
                    dragover: function () {
                        return false;
                    },
                    dragleave: function (e) {
                        $(this).removeClass('highlighted');
                        return false;
                    },
                    drop: function (e) {
                        var dt = e.originalEvent.dataTransfer;
                        $(e.target).closest('li').displayImg(dt.files, settings.previewImageSize);
                        return false;
                    }
                });


                uploadButton.click(function () {
                    var formdata = new FormData;

                    if (settings)
                        for (var key in settings) {
                            formdata.append(key, settings[key]);
                        }
                    imgList.children('li').each(function (indx) {
                        formdata.append("file[]", $(this).get(0).file);
                    });


                    formdata.append('_csrf', yii.getCsrfToken());
                    xhr = new XMLHttpRequest();
                    xhr.open("POST", url);
                    xhr.send(formdata);
                    xhr.onloadstart = function (event) {
                        uploadStatus.addClass('progress-bar-striped');
                        uploadStatus.removeClass('progress-bar-danger');
                        uploadStatus.attr({'aria-valuenow': 0}).width('0%');
                    };
                    xhr.onprogress = function (event) {
                        console.log('Загружено на сервер ' + event.loaded + ' байт из ' + event.total);
                        uploadStatus.attr({'aria-valuenow': event.loaded / (event.total / 100)}).width(event.loaded / (event.total / 100) + '%');
                    };
                    xhr.onerror = function (event) {
                        uploadStatus.attr({'aria-valuenow': 100}).width(100 + '%');
                        uploadStatus.removeClass('progress-bar-striped');
                        uploadStatus.addClass('progress-bar-danger');
                    };
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            settings.onSuccess(data)
                        } else {
                            alert("Ошибка ответа сервера");
                        }
                    };
                });
            });
        }
        else {
            console.log("Please enter valid URL for the upload.php file.");
            return false;
        }
    };

    $.fn.displayImg = function (file, img_size) {
        if (!file[0].type.match(/image.*/)) {
            return true;
        }

        var reader = new FileReader();
        this.get(0).file = file[0];
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.attr('src', e.target.result);
                aImg.attr('width', img_size);
            };
        })(this.find('img'));
        reader.readAsDataURL(file[0]);
    };

    $.fn.displayFilesInputCount = function (max_images, tpl) {
        console.log($(tpl));
        for (i = 0; i < max_images; i++) {
            var li = $('<li/>').appendTo(this);
            $(tpl).appendTo(li);
        }
    };
})(jQuery);