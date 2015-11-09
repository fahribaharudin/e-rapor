<form class="form-horizontal" id="MapelEditForm" action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<fieldset>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-6">
				<legend class="text-info">Informasi Mata Pelajaran</legend>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $mapel->id }}">
		<input type="hidden" name="paket_id" value="{{ $mapel->paket_id }}">

		<div class="form-group">
			<label for="input_nama_mapel" class="col-sm-2 control-label">Nama Mata Pelajaran</label>
			<div class="col-sm-6">
				<input type="text" name="nama" class="form-control" id="input_nama_mapel" placeholder="Nama Mata Pelajaran" value="{{ $mapel->child->nama_mapel }}">
			</div>
		</div>
		<div class="form-group">
			<label for="input_kelompok" class="col-sm-2 control-label">Kelompok</label>
			<div class="col-sm-2">
				<select class="form-control" name="kelompok" id="input_kelompok">
					<option {{ $mapel->kelompok == 'A' ? 'selected' : '' }}>A</option>
					<option {{ $mapel->kelompok == 'B' ? 'selected' : '' }}>B</option>
					<option {{ $mapel->kelompok == 'C1' ? 'selected' : '' }}>C1</option>
					<option {{ $mapel->kelompok == 'C2' ? 'selected' : '' }}>C2</option>
					<option {{ $mapel->kelompok == 'C3' ? 'selected' : '' }}>C3</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="input_semester" class="col-sm-2 control-label">Semester</label>
			<div class="col-sm-6" id="semester">
				@for($i=1; $i<=6; $i++)
					<label class="checkbox-inline">
						<input type="checkbox" name="input_semester_{{ $i }}" id="checkbox_semester_{{ $i }}" value="{{ $i }}" {{ in_array($i, explode(',', $mapel->semester)) ? 'checked' : '' }}> {{ $i }}
					</label>
				@endfor
			</div>
		</div>
	</fieldset>
	<br>
	<fieldset>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<legend class="text-info">Guru Mata Pelajaran</legend>
			</div>
		</div>
		@for($i=1; $i<=6; $i++)
			<div class="form-group">
				<label for="input_guru_semester_{{ $i }}" class="col-sm-2 control-label">Guru Semester {{ $i }}</label>
				<div class="col-sm-4">
					<select name="input_guru_semester_{{ $i }}" class="form-control" id="input_guru_semester_{{ $i }}" {{ ! in_array($i, explode(',', $mapel->semester)) ? 'disabled' : '' }}>
						<?php $guru = $mapel->guru()->where('semester', '=', $i)->first() ?>
						@if ($guru != null) 
							<option selected value="{{ $guru->id }}">{{ $guru->nama }}</option>
						@else
							<option selected value="0">Pilih Guru Mapel :</option>
						@endif
						@foreach ($semuaGuru as $guru)
							<option value="{{ $guru->id }}">{{ $guru->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>
		@endfor
	</fieldset>
	<div class="form-group">
		<label for="input_guru_semester_{{ $i }}" class="col-sm-2 control-label"></label>
		<div class="col-sm-4">
			<button class="btn btn-primary" type="submit">Update</button>
		</div>
	</div>
</form>