var ShowNilaiPengetahuanButton = {
	path: '',
	init: function(mapel_id, kelas_id, semester) {
		this.path = basePath + '/admin/mapel/' + mapel_id + '/kelas/' + kelas_id + '/semester/' + semester + '/nilai-pengetahuan/';
		this.cacheDom();
		this.render();
	},
	cacheDom: function() {
		this.$button = $('#ShowNilaiPengetahuanButton');
	},
	render: function() {
		var html = '<a href="' + this.path + '" class="btn btn-primary">Tampilkan</a>';
		this.$button.html(html);
	}
};

module.exports = ShowNilaiPengetahuanButton;