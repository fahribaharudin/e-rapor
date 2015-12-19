var ShowNilaiKeterampilanFromGuruButton = {
	path: '',
	init: function(mapel_id, kelas_id, semester) {
		this.path = basePath + '/guru/mapel/' + mapel_id + '/nilai-keterampilan/kelas/' + kelas_id + '/semester/' + semester
		this.cacheDom();
		this.render();
	},
	cacheDom: function() {
		this.$button = $('#ShowNilaiKeterampilanGuruButton');
	},
	render: function() {
		var html = '<a href="' + this.path + '" class="btn btn-primary">Tampilkan</a>';
		this.$button.html(html);
	}
};

module.exports = ShowNilaiKeterampilanFromGuruButton;