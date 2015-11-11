var ShowNilaiPengetahuanButton = require('./ShowNilaiPengetahuanButton');

var MapelFromKelasDropDown = {
	kelas_id: '',
	semester: '',
	options: [],
	init: function(kelas_id, semester) {
		this.kelas_id = kelas_id;
		this.semester = semester;
		this.options = [];
		this.cacheDom();
		this.loadDataFromServer();
	},
	cacheDom: function() {
		this.$selectBox = $('#MapelDropdown');
		this.$selectBox.on('change', function(evt) { this.handleChengeEvent(evt) }.bind(this));
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/nilai-pengetahuan/dropdown/kelas/' + this.kelas_id + '/semester/' + this.semester + '/mapel',
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
		this.options.push({value: 'null', text: 'Pilih Mapel :', selected: true});
		this.options.forEach(function(option) {
			var selected = option.selected ? 'selected' : '';
			html = html + '<option value="' + option.value + '" ' + selected + '>' + option.text + '</option>'
		});
		this.options = [];

		this.$selectBox.html(html);
		this.$selectBox.show();
	},
	handleChengeEvent: function(evt) {
		if(evt.currentTarget.value != 'null') {
			ShowNilaiPengetahuanButton.init(evt.currentTarget.value, this.kelas_id, this.semester);
		}
	}
};

module.exports = MapelFromKelasDropDown;