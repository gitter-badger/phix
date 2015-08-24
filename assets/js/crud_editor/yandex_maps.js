/* СКРИПТЫ РАБОТЫ С ЯНДЕКС-КАРТОЙ */

// Перерисовка яндекс-карты
function render_map(map, f_name, address) {
    console.log('render_map(' + map + ', ' + f_name + ', ' + address + ')');
    if (!! map) {console.log('Уничтожили карту'); map.destroy(); }
    // Запрос геокодирования
    ymaps.geocode(address, { results: 1 }).then(function (res) {
        // Панорамируем карту на точку
        var firstGeoObject = res.geoObjects.get(0);
        map = new ymaps.Map(f_name, {
            center: firstGeoObject.geometry.getCoordinates(),
            zoom: 10
        });
        map.controls.add('zoomControl', {
            float: 'none',
            position: {
                right: 40,
                top: 5
            }
        });
        // Задаем изображение для иконок меток.
        res.geoObjects.options.set('iconImageHref', 'favicon.png');
        res.geoObjects.options.set('iconImageSize', [32, 32]);
        res.geoObjects.options.set('iconImageOffset', [-16, -16]);
        // Добавляем полученную коллекцию на карту.
        map.geoObjects.add(res.geoObjects);
        // Заполняем значение широты и долготы
        $('input[name=' + f_name + '_long]').val(firstGeoObject.geometry.getCoordinates()[0]);
        $('input[name=' + f_name + '_atti]').val(firstGeoObject.geometry.getCoordinates()[1]);
    });
}

