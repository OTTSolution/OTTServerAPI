$(function(){
	$.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
	});

	$('.nav.navbar-nav').on('click', 'a[url]', function(){
		// $('a.active').removeClass('active');
		$(this).addClass('active');

		let url = $(this).attr('url');
		$.get(url, {}, function(data){
			$('.left-side').html(data);
			$('.right-side').empty();
			$('.left-item:first').trigger('click');
		});
	});

	$('.left-side').on('click', '.left-item', function(){
		$('.left-item.active').removeClass('active');
		$(this).addClass('active');

		let url = $(this).attr('url');
		$.get(url, {}, function(data){
			$('.right-side').html(data);
		});
	});

	$('.right-side').on('click', 'a[url]', function(){
		let url = $(this).attr('url');
		$.get(url, {}, function(data){
			$('.right-side').html(data);
		});
	});

	$('.right-side').on('submit', 'form', function(){
		let url = $(this).attr('action');
		let method = $(this).attr('method');
    	let formData = new FormData($(this)[0]);

    	let _method = $('.right-side input[name="_method"]');
    	if(_method.length && _method.val() == 'delete' && !confirm('确认删除?')){
    		return false;
    	}

		$.ajax({
			url: url,
			method: method,
			data: formData,
        	contentType: false,
        	processData: false
		}).done(function(data){
			$('.right-side').html(data);
		}).fail(function(jqXHR, textStatus, errorThrown){
			$('.alert.alert-danger').remove();
			let json = JSON.parse(jqXHR.responseText);
			let validation = '<div class="alert alert-danger"><ul>';
			for(let key in json){
				validation += '<li>' + json[key] + '</li>';
			}
			validation += '</ul></div>';
			$('.right-side').prepend(validation);
		});
		return false;
	});

});

$(function(){
	$('a[url]:first').trigger('click');
});