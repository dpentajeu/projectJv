$(document).ready(function() {
	var wizard = $('.wizard');
	var form = $('form[name=wizard]');

	// initialize button onClick
	(function(element) {
		btn = $(element).find('button');
		btn.click(function(e) {
			console.log($(this).data().type);
			type = $(this).data().type;
			obj = { type: type };
			if (type === 'datepicker') {
				obj.type = 'text';
				obj.datepicker = {};
			}
			form.dform('append', {
				type: 'container',
				class: 'row',
				html: [
					obj,
					{
						type: 'span',
						html: 'edit me',
						class: 'form-label',
						contenteditable: true,
					},
				],
			});
		});
		console.log(btn.length);
	}(wizard));

	form.dform({ method: 'post' });
});