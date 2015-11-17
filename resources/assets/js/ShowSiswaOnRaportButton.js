var ShowSiswaOnRaportButton = {
	path: '',
	init: function(kelas_id, semester) {
		this.path = basePath + '/admin/raport/kelas/' + kelas_id + '/semester/' + semester;
		this.cacheDom();
		this.render();
	},
	cacheDom: function() {
		this.$showButton = $('#ShowSiswaListFromRaportButtonn');
	},
	render: function() {
		var html = '<a href="'+ this.path +'" class="btn btn-primary">Tampilkan</a>';
		this.$showButton.html(html);
	}
};

module.exports = ShowSiswaOnRaportButton;