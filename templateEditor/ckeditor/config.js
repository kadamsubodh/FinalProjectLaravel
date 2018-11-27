/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {

    // Define changes to default configuration here. For example:  

    // config.language = 'fr';  

    // config.uiColor = '#AADC6E'; 
    config.extraPlugins = 'uploadimage'; 

    config.filebrowserBrowseUrl = '/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files';

    config.filebrowserImageBrowseUrl = '/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images';

    config.filebrowserFlashBrowseUrl = '/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash';

    config.filebrowserUploadUrl = '/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files';

    config.filebrowserImageUploadUrl = '/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images';

    config.filebrowserFlashUploadUrl = '/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash';

};

