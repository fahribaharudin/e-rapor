var SemesterDropDown = require('./SemesterDropDown');

var KelasDropDown = {
	options: [],
	init: function() {
		this.options = [{value: 'null', text: 'Pilih Kelas :'}];
		this.cacheDom();
		this.loadDataFromServer();
	},
	cacheDom: function() {
		this.$el = $('#NilaiPengetahuanNavigation');
		this.$selectBox = this.$el.find('#KelasDropdown');
		this.$selectBox.on('change', this.handleChangeEvent);
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/nilai-pengetahuan/dropdown/kelas',
			success: function(data) {
				data.forEach(function(data) {
					this.options.push(data);
				}.bind(this));

				this.render();

			}.bind(this)
		});
	},
	render: function() {
		var html = '';
		this.options.forEach(function(option) {
			html = html + '<option value="' + option.value + '">' + option.text + '</option>';
		});
		this.$selectBox.html(html);
	},
	handleChangeEvent(evt) {
		if (evt.currentTarget.value != 'null') {
			SemesterDropDown.init(evt.currentTarget.value);
		}
	}
};

module.exports = KelasDropDown;