var CreateUserForm  = {
	options: [],
	init: function() {
		this.cacheDom();
		this.render('admin');
	},
	cacheDom: function() {
		this.$levelSelect = $('#level');
		this.$levelSelect.on('change', function(evt) { this.handleLevelSelect(evt); }.bind(this));
	},
	render: function(status) {
		$('#namaField').html('');

		if (status == 'admin') {
			$('#namaField').html('\
				<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap">\
			');
		} else if (status == 'guru') {
			var html = '';
			this.options.forEach(function(guru) {
				html = html + '<option value="' + guru.id +  '">' + guru.nama + '</option>';
			});
			$('#namaField').html('\
				<select name="nama" id="nama" class="form-control">' + html + '</select>\
			');
		}

		this.options = [];
	},
	loadGuruData: function() {
		$.ajax({
			url: basePath + '/admin/guru-ajax',
			success: function(data) {
				data.forEach(function(guru) {
					this.options.push({ id: guru.id, nama: guru.nama });
				}.bind(this));

				this.render('guru');

			}.bind(this)
		});
	},
	loadAdminData: function() {
		this.options.push({ id: 0, nama: 'Administrator' });

		this.render('admin');
	},
	handleLevelSelect(evt) {
		var level = evt.currentTarget.value;

		if (level == 'walas' || level == 'guru') {
			this.loadGuruData();
		} else {
			this.loadAdminData();
		}
	}

};

module.exports = CreateUserForm;