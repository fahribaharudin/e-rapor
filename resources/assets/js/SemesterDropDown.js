var MapelFromKelasDropDown = require('./MapelFromKelasDropDown');

var SemesterDropDown = {
	kelas_id: '',
	options: [],
	init: function(kelas_id) {
		this.kelas_id = kelas_id;
		this.options = [ {value: 'null', text: 'Pilih Semester :'} ];
		this.cacheDom();
		this.loadDataFromServer();
	},
	cacheDom: function() {
		this.$selectBox = $('#SemesterDropdown');
		this.$selectBox.on('change', function(evt) { this.handleChangeEvent(evt); }.bind(this));
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/nilai-pengetahuan/dropdown/kelas/' + this.kelas_id + '/semester',
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
		this.$selectBox.show();
	},
	handleChangeEvent: function(evt) {
		if (evt.currentTarget.value != 0) {
			MapelFromKelasDropDown.init(this.kelas_id, evt.currentTarget.value);
		}
	}
};

module.exports = SemesterDropDown;