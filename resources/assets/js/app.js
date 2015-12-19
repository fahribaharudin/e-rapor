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
	else if ($('#NilaiPengetahuanIndex').length != 0) {
		var KelasDropDown = require('./KelasDropDown');
		KelasDropDown.init();
	}
	else if ($('#NilaiKeterampilanIndex').length != 0) {
		var KelasDropDown = require('./KelasDropDown');
		var MapelFromKelasDropDown = require('./MapelFromKelasDropDown');
		MapelFromKelasDropDown.handleChengeEvent = function(evt) {
			if (evt.currentTarget.value != 'null') {
				var ShowNilaiKeterampilanButton = require('./ShowNilaiKeterampilanButton');
				ShowNilaiKeterampilanButton.init(evt.currentTarget.value, this.kelas_id, this.semester);
			}
		}

		KelasDropDown.init();
	}
	else if ($('#NilaiSikapIndex').length != 0) {
		var KelasDropDown = require('./KelasDropDown');
		var MapelFromKelasDropDown = require('./MapelFromKelasDropDown');
		MapelFromKelasDropDown.handleChengeEvent = function(evt) {
			if (evt.currentTarget.value != 'null') {
				var ShowNilaiSikapButton = require('./ShowNilaiSikapButton');
				ShowNilaiSikapButton.init(evt.currentTarget.value, this.kelas_id, this.semester);
			}
		}

		KelasDropDown.init();
	}
	else if ($('#RaportIndex').length != 0) {
		var KelasDropDown = require('./KelasDropDown');
		var SemesterDropDown = require('./SemesterDropDown');
		SemesterDropDown.handleChangeEvent = function(evt) {
			if (evt.currentTarget.value != 'null') {
				var ShowSiswaOnRaportButton = require('./ShowSiswaOnRaportButton');
				ShowSiswaOnRaportButton.init(this.kelas_id, evt.currentTarget.value);
			}
		} 

		KelasDropDown.init();
	}
	else if ($('#UserCreate').length != 0) {
		var CreateUserForm = require('./CreateUserForm');
		CreateUserForm.init();
	} else if($('#GuruNilaiPengetahuanIndex').length != 0) {
		var MapelFromGuruDropDown = require('./MapelFromGuruDropDown');
		MapelFromGuruDropDown.init();
	} else if($('#GuruNilaiSikapIndex').length != 0) {
		var MapelFromGuruDropDown = require('./MapelFromGuruDropDown');
		var KelasFromGuruMapelDropDown = require('./KelasFromGuruMapelDropDown');
		KelasFromGuruMapelDropDown.handleChangeEvent = function(mapel_id, evt, semester) {
			if (evt.currentTarget.value != 'null') {
				var ShowNilaiSikapFromGuruButton = require('./ShowNilaiSikapFromGuruButton');
				ShowNilaiSikapFromGuruButton.init(mapel_id, evt.currentTarget.value, semester);
			}
		};
		MapelFromGuruDropDown.init();
	} else if($('#GuruNilaiKeterampilanIndex').length != 0) {
		var MapelFromGuruDropDown = require('./MapelFromGuruDropDown');
		var KelasFromGuruMapelDropDown = require('./KelasFromGuruMapelDropDown');
		KelasFromGuruMapelDropDown.handleChangeEvent = function(mapel_id, evt, semester) {
			if (evt.currentTarget.value != 'null') {
				var ShowNilaiKeterampilanFromGuruButton = require('./ShowNilaiKeterampilanFromGuruButton');
				ShowNilaiKeterampilanFromGuruButton.init(mapel_id, evt.currentTarget.value, semester);
			}
		};
		MapelFromGuruDropDown.init();
	}
});