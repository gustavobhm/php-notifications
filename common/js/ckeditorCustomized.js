$(function() {
	
	CKEDITOR.addCss('.cke_editable p { margin: 0; }');
	
	CKEDITOR.replace( 'editor', {
        filebrowserUploadUrl: "/common/recebeUpload.php",
        removeDialogTabs : 'link:target;link:advanced;image:Link;image:advanced',        
        toolbar :
        [
        ['ajaxsave'],
        ['Styles','Format','Font','FontSize','lineheight'],
        '/',        
        ['TextColor','BGColor'],
        ['Bold', 'Italic', 'Underline','Strike'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['NumberedList', 'BulletedList', 'Table' ],
        '/',
        ['Cut','Copy','Paste','PasteText'],
        ['Undo','Redo','-','RemoveFormat'],
        ['Link', 'Unlink', 'Image', '-', 'Maximize' ]
        ]
    } );
});