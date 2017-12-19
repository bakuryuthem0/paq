<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Ubicación</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					{{ $package->location }}
				</td>
				<td>
					<strong>Ubicación Actual</strong>
				</td>
			</tr>
			@foreach($locations as $l)
			<tr>
				<td>{{ $l->location }}</td>
				<td>{{ date('d-m-Y',strtotime($l->created_at)) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>