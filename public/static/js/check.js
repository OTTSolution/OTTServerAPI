$(function(){
	$("#addThemeInfo").click(function(){
		$("#addThemeInfo").before('<div class="app-theme">'+
			'<label>应用主题ID:</label>'+
			'<input type="text" name="themeId[]"/><br>'+
            '<label>应用主题图片:</label>'+
            '<input type="file" name="themeInfo[]"/>'+
            '<button type="button" class="btn btn-info" id="delete">删除</button></div>');
	});

	$("form").on('click', '#delete', function(){
		$(this).parent().remove();
	});
});