var ProgramDropdown = require('./ProgramDropdown');

/**
 * Bidang Keahlian Selectbox Module
 * @type {BidangDropdown}
 */
var BidangDropdown = {
	options: [
		{ text: 'Pilih Bidang Keahlian :', value: null }
	],
	init: function() {
		this.cacheDom();
		this.loadDataFromServer();
	},
	cacheDom: function() {
		this.$el = $('#mapelSelectorModule');
		this.$selectBox = this.$el.find('#bidangDropdown');
		this.$selectBox.on('change', this.handleChangeEvent);
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/mapel/select-box-feed/bidang',
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
			html = html + '<option value="' + data.value + '">' + data.text + '</option>';
		});

		this.$selectBox.html(html);
	},
	handleChangeEvent: function(evt) {
		if (evt.currentTarget.value != 'null') {
			ProgramDropdown.initiate(evt.currentTarget.value);
		}
	}.bind(this),
};

module.exports = BidangDropdown;