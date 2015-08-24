/* ИНИЦИАЛИЗАЦИЯ ПЛАГИНА ЗАГРУЗКИ ФОТО НА СЕРВЕР */

$(function(){
    var btnUpload = $('#[[ f_name ]]_btn_upload');
    var preloader = $('#[[ f_name ]]_pbar');
    new AjaxUpload(btnUpload, {
        action: './scripts/php/upload-photo.php?picture_type=[[ picture_type ]]&picture_element=[[ picture_element ]]&picture_field=[[ f_name ]]',
        name: 'uploadfile',
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|jpeg|png|gif)$/.test(ext))){
                // extension is not allowed 
                alert('Разрешенный формат изображения - JPG, PNG или GIF!');
                return false;
            }
            // Высвечиваем прогресс-бар
            preloader.show();
            btnUpload.hide();
            // Уничтожаем предыдущие картинки и плагины, если они были
            try {jcrop_api.destroy(); $('#target').remove();} catch (e) {}
        },
        onComplete: function(file, response){
            // По факту завершения загрузки гасим прогресс-бар
            console.log(response);
            preloader.hide();
            btnUpload.show();
            var answer;
            try {answer = $.parseJSON(response);} catch (e) {}
            if (answer != undefined) {
                if (answer.result === "ok") {
                    // Высвечиваем в окне имя закачанного файла
                    $('#modal_crop_filename').html(file);
                    // Открываем модальное окно
                    $('#modal_crop').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                    // Открываем картинку в модальном окне
                    $('#modal_crop_body').html('<img src="/pictures/tmp/compact/' + answer.filename + '" id="target" alt="" />');
                    // По факту подгрузки картинки навешиваем на нее Crop-плагин
                    $('#target').load(function () {
                        initJcrop([[ picture_proportions ]]);
                    });
					// Запоминаем id текущего изображения
					cur_crop_picture_id = answer.picture_id;
				} else alert('Ошибка!\r\n' + answer.error_txt);
			} else alert('Ошибка соединения с сервером!');
        }
    });
});	
