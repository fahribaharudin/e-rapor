<tr>
	<td>{{ $i }}</td>
	<td>{{ $mapel->child->nama_mapel }}</td>
	<td>{!! in_array(1, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
	<td>{!! in_array(1, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	<td>{!! in_array(2, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
	<td>{!! in_array(2, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	<td>{!! in_array(3, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
	<td>{!! in_array(3, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	<td>{!! in_array(4, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
	<td>{!! in_array(4, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	<td>{!! in_array(5, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
	<td>{!! in_array(5, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	<td>{!! in_array(6, explode(',', $mapel->semester)) ? '-' : '&nbsp;' !!}</td>
	<td>{!! in_array(6, explode(',', $mapel->semester)) ? '<small class="text-muted">n/a</small>' : '&nbsp;' !!}</td>
	<td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
	<td><a href="#"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>