var KelasFromGuruMapelDropDown = require('./KelasFromGuruMapelDropDown');

var MapelFromGuruDropDown = {
	options: [],
	init: function() {
		this.options = [{id: 'null', nama: 'Pilih Mapel :', paket_nama: '', semester: ''}];
		this.cacheDom();
		this.loadDataFromServer();
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/guru/nilai-pengetahuan/dropdown/mapel',
			success: function(data) {
				data.forEach(function(data) {
					this.options.push(data);
				}.bind(this));

				this.render();

			}.bind(this)
		});
	},
	cacheDom: function() {
		this.$selectBox = $('#MapelDropdown');
		this.$selectBox.on('change', this.handleChangeEvent);
	},
	render: function() {
		var html = '';
		this.options.forEach(function(option) {
			html = html + '<option value="' + option.id + '-' + option.semester + '">' + option.nama + ' - ' + option.paket_nama + ' - Semester: ' + option.semester + '</option>';
		});
		this.$selectBox.html(html);
	},
	handleChangeEvent: function(evt) {

		if (evt.currentTarget.value != 'null') {
			KelasFromGuruMapelDropDown.init(evt.currentTarget.value);
		}
	}

};

module.exports = MapelFromGuruDropDown;