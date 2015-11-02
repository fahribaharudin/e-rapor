@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA MATA PELAJARAN</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Mata Pelajaran</li>
				</ol>
				<hr>
				<table class="table">
					<tbody>
						<tr class="active">
							<td colspan="2"><h3>CARI MAPEL BERDASARKAN:</h3></td>
						</tr>
						<tr class=""> 
					        <td><b>Bidang Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="bidang" id="bidangDropdown">    
					                <option value="">Pilih Bidang Keahlian : </option>
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Program Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="program" id="programDropdown" style="display: none">    
					                
					            </select>
							</td>
						</tr>
						<tr class=""> 
					        <td><b>Paket Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="paket" id="paketDropdown" style="display: none">    
					                
					            </select>
							</td>
						</tr>
						<tr class="">
							<td></td>
							<td id="tampilkanButton"><a href="#" class="btn btn-primary" disabled>Tampilkan</a></td>
						</tr>
					</tbody>
				</table>
			</div>	
		</div>
	</div>

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			$.ajax({
				url: '{{ route('admin.mapel.select-box-feed.bidang') }}',
				success: function(data) {
					var bidangDropdown = '';
					data.map(function(data) {
						bidangDropdown = bidangDropdown + '<option value='+ data.value +'>'+ data.name +'</option>';
					});
					$('#bidangDropdown').append(bidangDropdown);
				}
			});

			$('#bidangDropdown').on('change', function() {
				var selected = $('#bidangDropdown').val() == '' ? null : $('#bidangDropdown').val();
				if (selected != null) {
					var url = '{{ route('admin.mapel.select-box-feed.program', '?') }}';

					$.ajax({
						url: (url.replace('?', selected)),
						success: function(data) {
							var programDropdown = '<option value="">Pilih Program Keahlian : </option>';
							data.map(function(data) {
								programDropdown = programDropdown + '<option value='+ data.value +'>'+ data.name +'</option>';
							});
							$('#programDropdown').html(programDropdown);
							$('#programDropdown').show();
						}
					});
				}
			});


			$('#programDropdown').on('change', function() {
				var selected = $('#programDropdown').val() == '' ? null : $('#programDropdown').val();

				if (selected != null) {
					var url = '{{ route('admin.mapel.select-box-feed.paket', '?') }}';
					
					$.ajax({
						url: (url.replace('?', selected)),
						success: function(data) {
							var paketDropdown = '<option value="">Pilih Paket Keahlian : </option>';
							data.map(function(data) {
								paketDropdown = paketDropdown + '<option value='+ data.value +'>'+ data.name +'</option>';
							});
							$('#paketDropdown').html(paketDropdown);
							$('#paketDropdown').show();
						}	
					});
				}
			});

			$('#paketDropdown').on('change', function() {
				var url = '{{ route('admin.mapel.paket.index', '?') }}';
				url = url.replace('?', $('#paketDropdown').val());

				$('#tampilkanButton').html('<a href="' + url + '" class="btn btn-primary">Tampilkan</a>');
			});

		});
	</script>
@endsection