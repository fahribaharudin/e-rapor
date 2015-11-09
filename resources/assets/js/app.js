$(document).ready(function() {
	if ($('#MapelIndex').length != 0) {
		var BidangDropdown = require('./BidangDropdown');
		BidangDropdown.init();
	}
	else if ($('#KompetensiIndex').length != 0) {
		var PaketDropdown = require('./PaketDropdown');
		PaketDropdown.handleChangeEvent = function(evt) {
			if (evt.currentTarget.value != 'null') {
				var MapelDropdown = require('./MapelDropdown');
				MapelDropdown.init(evt.currentTarget.value);
			}
		};
		var BidangDropdown = require('./BidangDropdown');
		BidangDropdown.init();
	}
	else if ($('#MapelEdit').length != 0) {
		var MapelEditForm = require('./MapelEditForm');
		MapelEditForm.init();
	}
});