@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA KOMPETENSI DASAR</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Kompetensi Dasar</li>
				</ol>
				<hr>
				<table class="table" id="mapelSelectorModule">
					<tbody>
						<tr class="active">
							<td colspan="2"><h3>CARI KOMPETENSI DASAR BERDASARKAN:</h3></td>
						</tr>
						<tr class=""> 
					        <td><b>Bidang Keahlian </b></td> 
					        <td>
					        	<select class="input-sm" name="bidang" id="bidangDropdown">    
					                {{-- <option value="">Pilih Bidang Keahlian : </option> --}}
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
					        <td><b>Mata Pelajaran </b></td> 
					        <td>
					        	<select class="input-sm" name="paket" id="mapelDropdown" style="display: none">    
					                
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

@section ('script')
	<script type="text/javascript">
		EraporApp.PaketDropdown.handleChangeEvent = function(evt) {
			if (evt.currentTarget.value != 'null') {
				EraporApp.MapelDropdown.init(evt.currentTarget.value);
			}
		};
		EraporApp.BidangDropdown.init();
	</script>
@endsection