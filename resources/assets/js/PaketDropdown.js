var ShowButton = require('./ShowButton');

/**
 * Paket Keahlian Selectbox Module
 * @type {PaketDropdown}
 */
var PaketDropdown = {
	programId: '',
	options: [],
	initiate: function(programId) {
		this.programId = programId;
		this.options = [];
		this.options.push({ text: 'Pilih Paket Keahlian :', value: null });
		
		this.cacheDom();
		this.loadDataFromServer();
	},
	cacheDom: function() {
		this.$el = $('#mapelSelectorModule');
		this.$selectBox = this.$el.find('#paketDropdown');
		this.$selectBox.on('change', this.handleChangeEvent);
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/mapel/select-box-feed/paket/' + this.programId,
			success: function(data) {
				data.forEach(function(option) {
					this.options.push(option);
				}.bind(this));

				// render! :)
				this.render();

			}.bind(this)
		});
	},
	render: function() {
		var html = '';
		this.options.forEach(function(data) {
			html = html + '<option value="' + data.value + '">' + data.text + '</option>'
		});
		this.$selectBox.html(html);
		this.$selectBox.show();
	},
	handleChangeEvent: function(evt) {
		if (evt.currentTarget.value != 'null') {
			ShowButton.initiate(basePath + '/admin/paket/' + evt.currentTarget.value + '/mapel');
		}
	}.bind(this),
};

module.exports = PaketDropdown;