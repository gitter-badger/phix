// Плагин всплывающих подсказок Dadata для поля ввода адреса [[ f_name ]]
$("input[name=[[ f_name ]]]").suggestions({
    serviceUrl: "https://dadata.ru/api/v2",
    token: "[[ dadata_api_key ]]",
    type: "EMAIL",
    // Вызывается, когда пользователь выбирает одну из подсказок
    onSelect: function(suggestion) {}
});