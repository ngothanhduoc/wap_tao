CKEDITOR.dialog.add('insertreviewgameDialog', function(editor) {
    return {
        title: 'Chèn Đánh giá Game',
        minWidth: 400,
        minHeight: 100,
        contents: [
            {
                id: 'reviewgame',
                label: 'Basic Settings',
                elements: [
//                    {
//                        type: 'text',
//                        id: 'full_name',
//                        label: 'Tên Game',
//                        labelLayout: 'horizontal',
//                        labelStyle: 'height: 24px; line-height:24px',
//                        widths: [60, 240],
//                        onShow: function() {
//                            
//                        }
//                        //validate: CKEDITOR.dialog.validate.notEmpty("Image field cannot be empty."),
//
//                    },
                    {
                        type: 'text',
                        id: 'id_game',
                        label: 'ID Game',
                        labelLayout: 'horizontal',
                        labelStyle: 'height: 24px; line-height:24px',
                        widths: [60, 240],
                        validate: CKEDITOR.dialog.validate.notEmpty("Id Game không được bỏ trống.")
                    }
                ]
            }
        ],
        onOk: function() {
            var dialog = this;
            var id = dialog.getValueOf('reviewgame', 'id_game');
            //var title = dialog.getValueOf('reviewgame', 'full_name');
            var p = editor.document.createElement('div');
            p.setAttribute('class', 'insert-review-game');
            p.setAttribute('style', 'color:#00FA2E');
            p.setAttribute('rel', id);
            p.setText('GAME::' + id);

            editor.insertElement(p);
        }
    };
});