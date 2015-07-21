CKEDITOR.dialog.add('twentytwentyDialog', function(editor) {
    return {
        title: 'So sánh hình ảnh',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'twenty',
                label: 'Basic Settings',
                elements: [
                    {
                        type: 'text',
                        id: 'image1',
                        label: 'Hình ảnh 1',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        validate: CKEDITOR.dialog.validate.notEmpty("Image field cannot be empty."),
                        onClick: function() {
                            openKCFinder(this);
                        }
                    },
                    {
                        type: 'text',
                        id: 'image2',
                        label: 'Hình ảnh 2',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        validate: CKEDITOR.dialog.validate.notEmpty("Image field cannot be empty."),
                        onClick: function() {
                            openKCFinder(this);
                        }
                    },
                    {
                        type: 'text',
                        id: 'title1',
                        label: 'Tiêu đề hình 1',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        validate: CKEDITOR.dialog.validate.notEmpty("Title field cannot be empty.")
                    },
                    {
                        type: 'text',
                        id: 'title2',
                        label: 'Tiêu đề hình 2',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        validate: CKEDITOR.dialog.validate.notEmpty("Title field cannot be empty.")
                    },
                    {
                        type: 'select',
                        id: 'options',
                        label: 'Options',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        items: [['Horizontal', 'horizontal'], ['Vertical', 'vertical']],
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
            var image1 = dialog.getValueOf('twenty', 'image1');
            var image2 = dialog.getValueOf('twenty', 'image2');
            var title1 = dialog.getValueOf('twenty', 'title1');
            var title2 = dialog.getValueOf('twenty', 'title2');
            var options = dialog.getValueOf('twenty', 'options');
            var description = dialog.getValueOf('twenty', 'description');
            var div = editor.document.createElement('div');
            div.setAttribute('class', 'twentytwenty-container');
            div.setAttribute('data-orientation', options);

            var img1 = editor.document.createElement('img');
            img1.setAttribute('src', image1);
            img1.setAttribute('style', 'width:50%;');
            img1.setAttribute('title', title1);
            var img2 = editor.document.createElement('img');
            img2.setAttribute('src', image2);
            img2.setAttribute('style', 'width:50%;');
            img2.setAttribute('title', title2);
            var des = editor.document.createElement('p');
            des.setText(description);

            div.append(img1);
            div.append(img2);
            div.append(des);

            editor.insertElement(div);
        }
    };
});