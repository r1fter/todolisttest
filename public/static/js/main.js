$(document).ready(function() {
	
	function getTasks() {
		if($('.tasks-list').hasClass('admin')) {
			var url = '/task/listadmin';
		} else {
			var url = '/task/list';
		}

		$.ajax({
			url: url,
			data: {
				'page': $('.pagination a.active').length ? $('.pagination a.active').data('index') : 1,
				'sort_by': $('.thead-link.sorted').length ? $('.thead-link.sorted').data('name') : null,
				'sort_order': $('.thead-link.sorted').length ? $('.thead-link.sorted').data('sortorder') : null,
			},
			success: function(result) {
				$('.tasks-list').html(result);
			},
			error: function(error) {
				$('.tasks-list').html('Error fetching data');
			}
		});
	}

	if($('.tasks-list').length > 0) {
		getTasks();
	}

	$('#task-form').submit(function(e) {
		e.preventDefault();
		$('.error').remove();
		$('.success').remove();

		$.ajax({
			type: "POST",
			url: '/task/create',
			data: $( this ).serialize(),
			success: function(result) {
				getTasks();
				$('#task-form')[0].reset();
				$('<div class="success my-2">Задание успешно создано!</div>').insertAfter('#task-form');
			},
			error: function(errors) {
				errors = $.parseJSON(errors.responseText)

				$.each(errors, function( name, value ) {
					$('<div class="error">'+value+'</div>').insertAfter('[name='+name+']');
				});
			}
		});
	});

	$('.container').on('click', '.page-link', function (e) {
		e.preventDefault();
		$('.pagination a.active').removeClass('active');
		$(this).addClass('active');

		getTasks();
	});

	$('.container').on('click', '.thead-link', function (e) {
		e.preventDefault();

		$('.thead-link.sorted').removeClass('sorted');

		$(this).addClass('sorted');

		let sort_order = $(this).data('sortorder');

		if(sort_order == 'desc') {
			$(this).data('sortorder', 'asc');
		} else {
			$(this).data('sortorder', 'desc');
		}

		getTasks();
	});
});
