(function ($) {
    $.fn.imageUpload = function (url, options) {
        if (url) {
            var global_res_data = [];
            var settings = $.extend({
                uploadButtonText: 'Загрузить',
                previewImageSize: 100,
                positions: [],
                img_tpl: '<img>',
                success: function (data) {

                }
            }, options);

            return this.each(function () {
                $(this).html('\
					<div id="img-container">\
					 	<ul id="img-list" style="padding-left: 0;"/>\
					</div>\
					<button type="button" id="upload-images">' + settings.uploadButtonText + '</button>\
				');

                var imgList = $('ul#img-list');
                imgList.displayFilesInputCount(settings.positions, settings.img_tpl);
                var fileInput = $('.file-field');
                var dropBox = $('.img-dropBox-container');
                var uploadButton = $('#upload-images');

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


                function uploadImages(li, i) {
                    var iterator = 0;
                    if (i > 0) {
                        iterator = i;
                    }
                    if ((li.length) == iterator) {
                        settings.success(global_res_data);
                        return true;
                    }

                    var formdata = new FormData();

                    var li_first = li[iterator];
                    var img = $(li_first).find('img');

                    if ((typeof(img.attr('src')) != 'undefined') && (img.attr('src').indexOf('/images') + 1 > 0)) {
                        var src_data = img.attr('src').split('/');
                        formdata.append("file", src_data[src_data.length - 1]);
                    } else {
                        formdata.append("file", li_first.file);
                    }
                    formdata.append("position", $(li_first).attr('position'));
                    formdata.append('_csrf', yii.getCsrfToken());

                    xhr = new XMLHttpRequest();
                    xhr.open("POST", url);
                    xhr.onloadstart = function (event) {
                        settings.onLoadstart();
                        $(li_first).css({'background': 'rgba(218, 215, 215, 0.3)'});
                        $(li_first).find('.progress-bar').addClass('progress-bar-striped');
                        $(li_first).find('.progress-bar').removeClass('progress-bar-danger');
                        $(li_first).find('.progress-bar').attr({'aria-valuenow': 0}).width('0%');
                    };
                    xhr.onprogress = function (event) {
                        console.log(event);
                        if (typeof (li_first.file) != 'undefined') {
                            console.log(li_first.file.size/1024);
                            console.log(event.loaded / ((li_first.file.size/1024) / 100));
                            $(li_first).find('.progress-bar').attr({'aria-valuenow': event.loaded / ((li_first.file.size/1024) / 100)}).width(event.loaded / ((li_first.file.size/1024) / 100) + '%');
                        } else {
                            $(li_first).find('.progress-bar').attr({'aria-valuenow': 100}).width(100 + '%');
                        }
                    };
                    xhr.onerror = function (event) {
                        $(li_first).css({'background': 'rgba(212, 74, 74, 0.3)'});
                        $(li_first).find('.progress-bar').attr({'aria-valuenow': 100}).width(100 + '%');
                        $(li_first).find('.progress-bar').removeClass('progress-bar-striped');
                        $(li_first).find('.progress-bar').addClass('progress-bar-danger');
                    };
                    xhr.onload = function () {
                        if (xhr.readyState == 4) {
                            if (xhr.status == 200) {
                                var data = JSON.parse(xhr.responseText);
                                console.log(data);
                                $(li_first).find('.progress-bar').attr({'aria-valuenow': 100}).width(100 + '%');
                                if (data === false) {
                                    $(li_first).css({'background': 'rgba(212, 74, 74, 0.3)'});
                                    $(li_first).find('.progress-bar').removeClass('progress-bar-striped');
                                    $(li_first).find('.progress-bar').addClass('progress-bar-danger');
                                } else {
                                    $(li_first).css({'background': 'rgba(77, 169, 49, 0.3)'});
                                    global_res_data.push(data);
                                }
                                //рекурсия, пока не выполним все запросы.
                                uploadImages(li, iterator + 1);
                            } else {
                                $(li_first).css({'background': 'rgba(212, 74, 74, 0.3)'});
                                $(li_first).find('.progress-bar').attr({'aria-valuenow': 100}).width(100 + '%');
                                $(li_first).find('.progress-bar').removeClass('progress-bar-striped');
                                $(li_first).find('.progress-bar').addClass('progress-bar-danger');
                            }
                        }


                    };
                    xhr.send(formdata);


                }

                uploadButton.click(function () {
                    global_res_data = [];
                    uploadImages(imgList.find('li'));
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
        this[0].file = file[0];
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.attr('src', e.target.result);
                aImg.attr('width', img_size);
            };
        })(this.find('img'));
        reader.readAsDataURL(file[0]);
    };

    $.fn.displayFilesInputCount = function (positions, tpl) {
        for (var key in positions) {
            var li = $('<li position="' + positions[key] + '"/>').appendTo(this);
            $(tpl).appendTo(li);
        }
    };


})(jQuery);