/**
 * ShowButton Module
 * @type {ShowButton}
 */
var ShowButton = {
	path: '#',
	initiate: function(path) {
		this.path = path;
		this.cacheDom();
		this.render();
	},
	cacheDom: function() {
		this.$el = $('#mapelSelectorModule');
		this.$button = this.$el.find('#tampilkanButton');
	},
	render: function() {
		var html = '<a href="' + this.path + '" class="btn btn-primary">Tampilkan</a>';
		this.$button.html(html);
	}
};

module.exports = ShowButton;