$(document).ready(function() {
	var wizard = $('.wizard');
	var form = $('form[name=wizard]');

	// initialize button onClick
	(function(element) {
		var btn = $(element).find('button');
		btn.click(function(e) {
			type = $(this).data().type;
			obj = { type: type, class: 'row' };
			if (type === 'datepicker') {
				obj.type = 'text';
				obj.datepicker = {};
			}

			form.dform('append', {
				type: 'container',
				class: 'row',
				html: [
					{
						type: 'span',
						html: 'Click here to edit text',
						class: 'form-label row',
						contenteditable: true,
					},
					obj,
				],
			});
		});
	}(wizard));

	form.dform({ method: 'post' });
});