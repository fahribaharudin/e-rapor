var ShowNilaiPengetahuanFromGuruButton = require('./ShowNilaiPengetahuanFromGuruButton');

var KelasFromGuruMapelDropDown = {
	options: [],
	init: function(kode) {
		var code = kode.split('-');
		this.mapel_id = code[0];
		this.semester = code[1];
		this.cacheDom();
		this.loadDataFromServer();
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/guru/nilai-pengetahuan/dropdown/mapel/' + this.mapel_id + '/semester/' + this.semester,
			success: function(data) {
				console.log(data);
				data.forEach(function(data) {
					this.options.push(data);
				}.bind(this));

				this.render();

			}.bind(this)
		});
	},
	cacheDom: function() {
		this.$selectBox = $('#KelasDropdown');
		this.$selectBox.on('change', function(evt) {
			this.handleChangeEvent(this.mapel_id, evt, this.semester);
		}.bind(this));
	},
	render: function() {
		var html = '';
		this.options.forEach(function(option) {
			html = html + '<option value="' + option.id + '">' + option.nama_kelas + ' - tingkat: ' + option.tingkat_kelas + '</option>';
		});
		this.$selectBox.html(html);
		this.options = [];
	},
	handleChangeEvent: function(mapel_id, evt, semester) {
		
		if (evt.currentTarget.value != 'null') {
			ShowNilaiPengetahuanFromGuruButton.init(mapel_id, evt.currentTarget.value, semester);
		}
	}
};

module.exports = KelasFromGuruMapelDropDown;