var EraporApp = {

	/**
	 * Bidang Keahlian Selectbox Module
	 * @type {BidangDropdown}
	 */
	BidangDropdown: {
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
				EraporApp.ProgramDropdown.initiate(evt.currentTarget.value);
			}
		}.bind(this),
	},


	/**
	 * Program Keahlian Selectbox Module
	 * @type {ProgramDropdown}
	 */
	ProgramDropdown: {
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
				EraporApp.PaketDropdown.initiate(evt.currentTarget.value);
			}
		}.bind(this),
	},


	/**
	 * Paket Keahlian Selectbox Module
	 * @type {PaketDropdown}
	 */
	PaketDropdown: {
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
				EraporApp.ShowButton.initiate(basePath + '/admin/mapel/paket/' + evt.currentTarget.value);
			}
		}.bind(this),
	},


	/**
	 * Mata Pelajaran SelectBox Module
	 * @type {MapelDropdown}
	 */
	MapelDropdown: {
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
			this.$el = $('#mapelSelectorModule');
			this.$selectBox = this.$el.find('#mapelDropdown');
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
				EraporApp.ShowButton.initiate(basePath + '/admin/kompetensi-dasar/mapel/' + evt.currentTarget.value);
			}
		}
	},


	/**
	 * ShowButton Module
	 * @type {ShowButton}
	 */
	ShowButton: {
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
	}	

}