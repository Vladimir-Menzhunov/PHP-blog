$(document).ready(function() { // запускает функцию после загрузки всех форм
	$('form').submit(function(event) { // Обращение к форме, обработка любых событий
		var json;
		event.preventDefault(); // отключение отправки html формы
		$.ajax({ // Получаем информацию формы через ajax - без перезагрузки страницы
			type: $(this).attr('method'), // Получаем атрибут используемой формы, тип запроса
			url: $(this).attr('action'),
			data: new FormData(this), // Получаем данные из формы
			contentType: false, // Не передаём никакие заголовки
			cache: false, // Отключим кеширование
			processData: false, // не преобразовываем данные в строку
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = json.url;
				} else {
					alert(json.status + ' - ' + json.message); // выводит оконное сообщение
				}
			},
		});
	});
});