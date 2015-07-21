CKEDITOR.dialog.add('embedarticleDialog', function(editor) {
    return {
        title: 'Chèn Bài viết khác',
        minWidth: 400,
        minHeight: 300,
        contents: [
            {
                id: 'embed',
                label: 'Basic Settings',
                elements: [
                    {
                        type: 'text',
                        id: 'image',
                        label: 'Hình ảnh',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        //validate: CKEDITOR.dialog.validate.notEmpty("Image field cannot be empty."),
                        onClick: function() {
                            openKCFinder(this);
                        }
                    },
                    {
                        type: 'text',
                        id: 'title',
                        label: 'Tiêu đề',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        //validate: CKEDITOR.dialog.validate.notEmpty("Title field cannot be empty.")
                    },
                    {
                        type: 'text',
                        id: 'id',
                        label: 'ID Bài viết',
                        style: 'width:53%',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 100],
                        validate: CKEDITOR.dialog.validate.regex(/^[0-9]+$/, "Please enter a valid number.")
                    },
                    {
                        type: 'select',
                        id: 'type',
                        label: 'Type',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        items: [['Tin tức', '1'], ['Video', '2'], ['Giftcode', '3']],
                        'default': '1',
                        onChange: function(api) {
                            // this = CKEDITOR.ui.dialog.select
                            //alert('Current value: ' + this.getValue());
                        }
                    },
                    {
                        type: 'textarea',
                        id: 'description',
                        label: 'Mô tả',
                        //validate: CKEDITOR.dialog.validate.notEmpty("Description field cannot be empty.")
                    }
                ]
            }
        ],
        onOk: function() {
            var dialog = this;
            var id = dialog.getValueOf('embed', 'id');
            var title = dialog.getValueOf('embed', 'title');
            var image = dialog.getValueOf('embed', 'image');
            var description = dialog.getValueOf('embed', 'description');
            var type = dialog.getValueOf('embed', 'type');
            var dbtitle = '', dbimage = '', dbdescription = '';
            $.ajax({
                url: '/backend/ajax/getEmbedNews?id=' + id + '&type=' + type,
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.code == 0) {
                        if (type == 1) {
                            dbtitle = response.data.title;
                            dbimage = response.data.image_banner;
                            dbdescription = response.data.description;
                        } else if (type == 2) {
                            dbtitle = response.data.title;
                            dbimage = response.data.image;
                            dbdescription = response.data.description;
                        } else {
                            dbtitle = response.data.name;
                            dbimage = response.data.image;
                        }
                        var div = editor.document.createElement('div');
                        div.setAttribute('style', 'margin: 0 auto;width: 100%; max-width:596px; height:100%; max-height: 118px;overflow: hidden;padding: 0;border: 1px solid #ededed;');
                        div.setAttribute('class', 'insert-article-id');
                        div.setAttribute('rev', type);
                        div.setAttribute('rel', id);

                        var span = editor.document.createElement('h2');
                        span.setAttribute('style', 'font: 11pt/1.231 arial,clean,sans-serif; color: #e30114; margin: 10px 5px;text-align: left;line-height: 22px;max-height: 43px;overflow: hidden;text-overflow: ellipsis;');
                        span.setText((title != '') ? title : dbtitle);

                        var img = editor.document.createElement('img');
                        img.setAttribute('src', (image != '') ? image : dbimage);
                        img.setAttribute('style', 'float: left;margin-right: 20px;width: 30%;max-width: 198px; max-height: 118px;');

                        var des = editor.document.createElement('span');
                        des.setAttribute('style', 'line-height: 18px;max-height: 73px;overflow: hidden;color: #494949;text-align: justify;width: 380px;float: left; font-size:12px');
                        des.setText((description != '') ? description : dbdescription);

                        div.append(img);
                        div.append(span);
                        //a.append(title);
                        //div.append(br);
                        div.append(des);

                        editor.insertElement(div);
                    } else {

                    }
                }
            });
        }
    };
});