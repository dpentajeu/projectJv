$(document).ready(function() {
	var wizard = $('.wizard');
	var form = $('form[name=wizard]');

	// initialize button onClick
	(function(element) {
		var btn = $(element).find('button');
		btn.click(function(e) {
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
						html: 'insert label name',
						class: 'form-label',
						contenteditable: true,
					},
				],
			});
		});
	}(wizard));

	form.dform({ method: 'post' });
});