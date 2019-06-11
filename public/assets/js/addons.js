define([], function () {
    require([], function () {
    //绑定data-toggle=addresspicker属性点击事件

    $(document).on('click', "[data-toggle='addresspicker']", function () {
        var that = this;
        var callback = $(that).data('callback');
        var input_id = $(that).data("input-id") ? $(that).data("input-id") : "";
        var lat_id = $(that).data("lat-id") ? $(that).data("lat-id") : "";
        var lng_id = $(that).data("lng-id") ? $(that).data("lng-id") : "";
        var lat = lat_id ? $("#" + lat_id).val() : '';
        var lng = lng_id ? $("#" + lng_id).val() : '';
        var url = "/addons/address/index/select";
        url += (lat && lng) ? '?lat=' + lat + '&lng=' + lng : '';
        Fast.api.open(url, '位置选择', {
            callback: function (res) {
                input_id && $("#" + input_id).val(res.address);
                lat_id && $("#" + lat_id).val(res.lat);
                lng_id && $("#" + lng_id).val(res.lng);
                try {
                    //执行回调函数
                    if (typeof callback === 'function') {
                        callback.call(that, res);
                    }
                } catch (e) {

                }
            }
        });
    });
});

require.config({
    paths: {
        'nkeditor': '../addons/nkeditor/js/customplugin',
        'nkeditor-core': '../addons/nkeditor/nkeditor.min',
        'nkeditor-lang': '../addons/nkeditor/lang/zh-CN',
    },
    shim: {
        'nkeditor': {
            deps: [
                'nkeditor-core',
                'nkeditor-lang'
            ]
        },
        'nkeditor-core': {
            deps: [
                'css!../addons/nkeditor/themes/black/editor.min.css'
            ],
            exports: 'window.KindEditor'
        },
        'nkeditor-lang': {
            deps: [
                'nkeditor-core'
            ]
        }
    }
});
if ($(".editor").size() > 0) {
    require(['nkeditor', 'upload'], function (Nkeditor, Upload) {
        var getImageFromClipboard, getImagesFromDrop;
        getImageFromClipboard = function (data) {
            var i, item;
            i = 0;
            while (i < data.clipboardData.items.length) {
                item = data.clipboardData.items[i];
                if (item.type.indexOf("image") !== -1) {
                    return item.getAsFile() || false;
                }
                i++;
            }
            return false;
        };
        getImagesFromDrop = function (data) {
            var i, item, images;
            i = 0;
            images = [];
            while (i < data.dataTransfer.files.length) {
                item = data.dataTransfer.files[i];
                if (item.type.indexOf("image") !== -1) {
                    images.push(item);
                }
                i++;
            }
            return images;
        };
        $(".editor").each(function () {
            var that = this;
            Nkeditor.create(that, {
                filterMode: false,
                wellFormatMode: false,
                allowMediaUpload: true, //是否允许媒体上传
                allowFileManager: true,
                allowImageUpload: true,
                fillDescAfterUploadImage: false, //是否在上传后继续添加描述信息
                themeType: typeof Config.nkeditor != 'undefined' ? Config.nkeditor.theme : 'black', //编辑器皮肤,这个值从后台获取
                fileManagerJson: Fast.api.fixurl("/addons/nkeditor/index/attachment/module/" + Config.modulename),
                items: [
                    'source', 'undo', 'redo', 'preview', 'print', 'template', 'code', 'quote', 'cut', 'copy', 'paste',
                    'plainpaste', 'wordpaste', 'justifyleft', 'justifycenter', 'justifyright',
                    'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                    'superscript', 'clearhtml', 'quickformat', 'selectall',
                    'formatblock', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold',
                    'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', 'image', 'multiimage', 'graft',
                    'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                    'anchor', 'link', 'unlink', 'about', 'fullscreen'
                ],
                afterCreate: function () {
                    var self = this;
                    //Ctrl+回车提交
                    Nkeditor.ctrl(document, 13, function () {
                        self.sync();
                        $(that).closest("form").submit();
                    });
                    Nkeditor.ctrl(self.edit.doc, 13, function () {
                        self.sync();
                        $(that).closest("form").submit();
                    });
                    //粘贴上传
                    $("body", self.edit.doc).bind('paste', function (event) {
                        var image, pasteEvent;
                        pasteEvent = event.originalEvent;
                        if (pasteEvent.clipboardData && pasteEvent.clipboardData.items) {
                            image = getImageFromClipboard(pasteEvent);
                            if (image) {
                                event.preventDefault();
                                Upload.api.send(image, function (data) {
                                    self.exec("insertimage", Fast.api.cdnurl(data.url));
                                });
                            }
                        }
                    });
                    //挺拽上传
                    $("body", self.edit.doc).bind('drop', function (event) {
                        var image, pasteEvent;
                        pasteEvent = event.originalEvent;
                        if (pasteEvent.dataTransfer && pasteEvent.dataTransfer.files) {
                            images = getImagesFromDrop(pasteEvent);
                            if (images.length > 0) {
                                event.preventDefault();
                                $.each(images, function (i, image) {
                                    Upload.api.send(image, function (data) {
                                        self.exec("insertimage", Fast.api.cdnurl(data.url));
                                    });
                                });
                            }
                        }
                    });
                },
                //FastAdmin自定义处理
                beforeUpload: function (callback, file) {
                    var file = file ? file : $("input.ke-upload-file", this.form).prop('files')[0];
                    Upload.api.send(file, function (data) {
                        var data = {code: '000', data: {url: Fast.api.cdnurl(data.url)}, title: '', width: '', height: '', border: '', align: ''};
                        callback(data);
                    });

                },
                //错误处理 handler
                errorMsgHandler: function (message, type) {
                    try {
                        console.log(message, type);
                    } catch (Error) {
                        alert(message);
                    }
                }
            });
        });
    });
}

//修改上传的接口调用
require(['upload'], function (Upload) {
    var _onUploadResponse = Upload.events.onUploadResponse;
    Upload.events.onUploadResponse = function (response) {
        try {
            var ret = typeof response === 'object' ? response : JSON.parse(response);
            if (ret.hasOwnProperty("code") && ret.hasOwnProperty("data")) {
                return _onUploadResponse.call(this, response);
            } else if (ret.hasOwnProperty("key") && !ret.hasOwnProperty("err_code")) {
                ret.code = 1;
                ret.data = {
                    url: '/' + ret.key
                };
                return _onUploadResponse.call(this, JSON.stringify(ret));
            }
        } catch (e) {
        }
        return _onUploadResponse.call(this, response);

    };
});
});