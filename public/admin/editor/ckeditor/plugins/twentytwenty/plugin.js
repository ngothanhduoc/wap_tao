/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

CKEDITOR.plugins.add('twentytwenty', {
    icons: 'twentytwenty',
    init: function(editor) {
        editor.addCommand('twentytwenty', new CKEDITOR.dialogCommand('twentytwentyDialog'));
        editor.ui.addButton('Compatibility Images', {
            label: 'Compatibility Images',
            command: 'twentytwenty',
            toolbar: 'insert',
            icon: this.path + 'icons/twentytwenty.png'
        });
        CKEDITOR.dialog.add('twentytwentyDialog', this.path + 'dialogs/twentytwenty.js');
    }
});