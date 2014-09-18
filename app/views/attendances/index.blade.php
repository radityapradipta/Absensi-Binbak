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
				<?php $absence_day = $employee->count_absence_day(9, 2014); ?>
				{{-- lihat tabel absence_categories --}}
				<td>{{ $absence_day[5-1] }}{{-- izin --}}</td>
				<td>{{ $absence_day[7-1] }}{{-- sakit --}}</td>
				<td>{{ $absence_day[4-1] }}{{-- tugas luar --}}</td>
				<td>{{ $absence_day[8-1] }}{{-- lupa --}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td>{{ $absence_day[3-1] + $absence_day[6-1] }}{{-- other + cuti --}}</td>
			</tr>	
		@endforeach
	
	</table>
@stop
