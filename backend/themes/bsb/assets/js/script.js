function search(){
    var form = $('#form-search');
    $.pjax.reload({
        url: 'index.php',
        container: '#table',
        type: 'GET',
        timeout: 5000,
        data: form.serialize(),
    });
    
    return false;
}