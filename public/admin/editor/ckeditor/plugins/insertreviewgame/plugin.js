/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

CKEDITOR.plugins.add('insertreviewgame', {
    icons: 'insertreviewgame',
    init: function(editor) {
        // Plugin logic goes here...
        editor.addCommand('insertreviewgame', new CKEDITOR.dialogCommand('insertreviewgameDialog'));
        editor.ui.addButton('InsertReviewGame', {
            label: 'Chèn Đánh Giá Game',
            command: 'insertreviewgame',
            toolbar: 'insert',
            icon: this.path + 'icons/insertreviewgame.png'
        });

        CKEDITOR.dialog.add('insertreviewgameDialog', this.path + 'dialogs/insertreviewgame.js');
    }
});
