var PaketDropdown = require('./PaketDropdown');

/**
 * Program Keahlian Selectbox Module
 * @type {ProgramDropdown}
 */
var ProgramDropdown = {
	bidangId: null,
	options: [],
	initiate: function(bidangId) {
		this.bidangId = bidangId;
		this.options = [];
		this.options.push({ text: 'Pilih Progam Keahlian :', value: null });

		this.cacheDom(); 
		this.loadDataFromServer();
	},
	loadDataFromServer: function() {
		$.ajax({
			url: basePath + '/admin/mapel/select-box-feed/program/' +  this.bidangId,
			success: function(data) {
				data.forEach(function(option) {
					this.options.push(option);
				}.bind(this));

				// render! :)
				this.render();

			}.bind(this),
		});
	},
	cacheDom: function() {
		this.$el = $('#mapelSelectorModule');
		this.$selectBox = this.$el.find('#programDropdown');
		this.$selectBox.on('change', this.handleChangeEvent);
	},
	render: function() {
		var html = '';
		this.options.forEach(function(option) {
			html = html + '<option value="' + option.value + '">' + option.text  + '</option>'
		});
		this.$selectBox.html(html);
		this.$selectBox.show();
	},
	handleChangeEvent: function(evt) {
		if (evt.currentTarget.value != 'null') {
			PaketDropdown.initiate(evt.currentTarget.value);
		}
	}.bind(this),
};

module.exports = ProgramDropdown;