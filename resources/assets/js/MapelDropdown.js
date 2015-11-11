var ShowButton = require('./ShowButton');

/**
 * Mata Pelajaran SelectBox Module
 * @type {MapelDropdown}
 */
var MapelDropdown = {
	paketId: '',
	options: [],
	init: function(paketId) {
		this.paketId = paketId;
		this.options = [];
		this.options.push({ text: 'Pilih Mata Pelajaran', value: null });
		this.cacheDom();
		this.loadDataFromServer();
	},
	cacheDom: function() {
		this.$selectBox = $('#mapelDropdown');
		this.$selectBox.on('change', this.handleChangeEvent);
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/kompetensi-dasar/select-box-feed/mapel/' + this.paketId,
			success: function(data) {
				data.forEach(function(data) {
					this.options.push(data);
				}.bind(this));

				// render! :)
				this.render();

			}.bind(this)
		});
	},
	render: function() {
		var html = '';
		this.options.forEach(function(data) {
			html = html + '<option value="' + data.value + '">' + data.text + '</option>';
		});
		this.$selectBox.show();
		this.$selectBox.html(html);
	},
	handleChangeEvent: function(evt) {
		if (evt.currentTarget.value != 'null') {
			ShowButton.initiate(basePath + '/admin/mapel/' + evt.currentTarget.value + '/kompetensi-dasar');
		}
	}
};

module.exports = MapelDropdown;