function list_element_delete(rl_id, el_url, el_id) {
    if (!!! rl_id) return;
    console.log("pages/ajax/" + el_url);
    $.ajax({
        url: "pages/ajax/" + el_url,
        type: "GET",
        data: 'method=delete&parent_id=&id=' + rl_id, /*TODO: parent_id=<? echo $data_in['id']; ?>*/
        dataType: "html",
        success: function(answer) {
            if (answer != '') {
                $('#' + el_id + '_list').html(answer);
            } else alert ('Ошибка соединения');
        }
    });
}

function picture_delete(picture_id) {
    if (!!! picture_id) return;
    if (!confirm('Вы действительно хотите удалить элемент?')) return;
    console.log("pages/ajax/picture_delete.php");
    $.ajax({
        url: "pages/ajax/picture_delete.php",
        type: "POST",
        data: 'picture_id=' + picture_id,
        dataType: "html",
        success: function(answer) {
            if (answer == 'ok') {
                $('#picture_' + picture_id).remove();
            } else alert ('Ошибка!\r\n' + answer);
        }
    });
}
