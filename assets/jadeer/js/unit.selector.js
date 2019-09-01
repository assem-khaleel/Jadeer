$('#search-unit').html('');

function search(btn) {
	$.get('/Unit/load_unit', {keyword: $('#keyword').val()})
		.done(function (msg) {
			$('#search-unit').html(msg);
		});
}

$('#keyword').on('click', function (e) {
	$.get('/Unit/load_unit', {keyword: $('#keyword').val()})
		.done(function (msg) {
			$('#search-unit').html(msg);
		});
});
$(document).on('click',".unit_select",function () {
	console.log($(this).prop('checked'));
	if($(this).prop('checked')){
		var id=$(this).val();
		$("#selected_unit").val(id);

		$("#unit_label").html($(".until-label[data-id='"+id+"']").html());
	}
});
$('#unitInput').on('focus', function (e) {
	e.preventDefault();
	$.get({
		url: '/kpi/load_unit',
		data: {}
	}).done(function (msg) {
		$('#search-unit').html(msg);
	});
});