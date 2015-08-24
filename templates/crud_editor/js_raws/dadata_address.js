// Плагин всплывающих подсказок Dadata для поля ввода адреса [[ f_name ]]
$("input[name=[[ f_name ]]]").suggestions({
    serviceUrl: "https://dadata.ru/api/v2",
    token: "154fa715902b207f0c64b376646db03631fa273e",
    type: "ADDRESS",
    // Вызывается, когда пользователь выбирает одну из подсказок
    onSelect: function(suggestion) {
        // render_map([[ f_name ]]_map, '[[ f_name ]]', suggestion.value);
    }
});