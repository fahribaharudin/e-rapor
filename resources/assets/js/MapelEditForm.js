var MapelEditForm = {
	init: function() {
		this.cacheDom();
		this.render();
	},
	cacheDom: function() {
		this.$el = $('#MapelEditForm');
		this.$semesterCheckBox = [];
		this.$guruDropdown = [];
		for (var i=1; i<=6; i++) {
			this.$semesterCheckBox.push(this.$el.find('#checkbox_semester_' + i));
			this.$guruDropdown.push(this.$el.find('#input_guru_semester_' + i));
		}
		this.$semesterCheckBox.forEach(function(el) {
			el.on('click', function(evt) {
				this.handleSemesterCheckBoxEvent(evt, el)
			}.bind(this));
		}.bind(this));
	},
	render: function() {
		// 
	},
	handleSemesterCheckBoxEvent: function(evt, el) {
		var guruDropdown = this.$guruDropdown[el.val() - 1];
		guruDropdown.prop('disabled', function(i, v) {
			return !v;
		});
		guruDropdown.val(0);
	}
};

module.exports = MapelEditForm;