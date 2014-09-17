@extends('layouts.tester')

@section('custom')
	<p>This is appended to the master sidebar.</p>  @parent
@stop

@section('content')
    <p>This is my body content.</p>
	<table border="1">
		<tr>
			<th>Kode Guru</th>
			<th>Nama Guru</th>
			<th>Unit</th>
			<th>Izin</th>
			<th>Sakit</th>
			<th>Tugas Luar</th>
			<th>Lupa</th>
			<th>Terlambat</th>
			<th>Pulang Awal</th>
			<th>Alpa</th>
			<th>Other</th>
		</tr>
		
		@foreach ($employees as $employee)	
			<tr>
				<td>{{ $employee->ssn or '-' }}</td>
				<td>{{ $employee->name or '-' }}</td>
				<td>{{ $employee->department->name or '-' }}</td>
			</tr>	
		@endforeach
	
	</table>
@stop
