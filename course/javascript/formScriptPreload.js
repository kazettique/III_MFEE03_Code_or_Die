// Loading CKEditor
CKEDITOR.replace('c_intro', {
    language: 'zh',
    width: '100%'
});

function getTextareaContent() {
    let editorText = CKEDITOR.instances.c_intro.getData();
    // console.log('[line.154] editorText: ' + editorText);
    return editorText;
}

getTextareaContent();

// get date of today and set into c_startDate
let today = getToday();
// console.log('today: ' + today);
$('#c_startDate').attr('value', today);