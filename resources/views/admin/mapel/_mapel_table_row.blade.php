<tr>
	<td>{{ $i }}</td>
	<td>{{ $mapel->child->nama_mapel }}</td>
	@if (in_array(1, explode(',', $mapel->semester)) && $mapel->guru()->where('semester', '=', 1)->first() != null)
		<td>&radic;</td>
		<td><span class="text-info">{{ $mapel->guru()->where('semester', '=', 1)->first()->nama }}</span></td>
	@else
		<td>{!! in_array(1, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
		<td>{!! in_array(1, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	@endif
	
	@if (in_array(2, explode(',', $mapel->semester)) && $mapel->guru()->where('semester', '=', 2)->first() != null)
		<td>&radic;</td>
		<td><span class="text-info">{{ $mapel->guru()->where('semester', '=', 2)->first()->nama }}</span></td>
	@else
		<td>{!! in_array(2, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
		<td>{!! in_array(2, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	@endif
	
	@if (in_array(3, explode(',', $mapel->semester)) && $mapel->guru()->where('semester', '=', 3)->first() != null)
		<td>&radic;</td>
		<td><span class="text-info">{{ $mapel->guru()->where('semester', '=', 3)->first()->nama }}</span></td>
	@else
		<td>{!! in_array(3, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
		<td>{!! in_array(3, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	@endif
	
	@if (in_array(4, explode(',', $mapel->semester)) && $mapel->guru()->where('semester', '=', 4)->first() != null)
		<td>&radic;</td>
		<td><span class="text-info">{{ $mapel->guru()->where('semester', '=', 4)->first()->nama }}</span></td>
	@else
		<td>{!! in_array(4, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
		<td>{!! in_array(4, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	@endif
	
	@if (in_array(5, explode(',', $mapel->semester)) && $mapel->guru()->where('semester', '=', 5)->first() != null)
		<td>&radic;</td>
		<td><span class="text-info">{{ $mapel->guru()->where('semester', '=', 5)->first()->nama }}</span></td>
	@else
		<td>{!! in_array(5, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
		<td>{!! in_array(5, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	@endif
	
	@if (in_array(6, explode(',', $mapel->semester)) && $mapel->guru()->where('semester', '=', 6)->first() != null)
		<td>&radic;</td>
		<td><span class="text-info">{{ $mapel->guru()->where('semester', '=', 6)->first()->nama }}</span></td>
	@else
		<td>{!! in_array(6, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
		<td>{!! in_array(6, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	@endif
	
	<td><a href="{{ route('admin.mapel.edit', $mapel->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
	<td><a href="#"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>