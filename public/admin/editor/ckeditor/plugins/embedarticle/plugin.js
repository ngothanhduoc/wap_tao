/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

CKEDITOR.plugins.add('embedarticle', {
    icons: 'embedarticle',
    init: function(editor) {
        // Plugin logic goes here...
        editor.addCommand('embedarticle', new CKEDITOR.dialogCommand('embedarticleDialog'));
        editor.ui.addButton('Embedarticle', {
            label: 'Embed Article',
            command: 'embedarticle',
            toolbar: 'insert'
        });

        CKEDITOR.dialog.add('embedarticleDialog', this.path + 'dialogs/embedarticle.js');
    }
});
