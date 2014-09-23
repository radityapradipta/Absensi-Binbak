@extends('layouts.tester')

@section('custom')
	<p>This is appended to the master sidebar.</p>  @parent
@stop

@section('content')
	
	<br/><br/><br/><br/><br/>
	<select>
		<?php $month=array("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"); ?>
		@for($i=1; $i<=12; $i++)	
		<option value=="$i">{{ $month[$i-1] }}<option>
		@endfor
	</select>
		
	<select>
		@for($i=2000; $i<=2099; $i++)	
		<option value=="$i">{{ $i }}<option>
		@endfor
	</select>

	<table class="absent-table">
		<tr>
			<th rowspan="2" class="thin-border">Kode</th>
			<th rowspan="2" class="thick-border">Nama</th>
			<!--<th rowspan="2">Unit</th>-->
			
			<th colspan="2" class="thin-border">Normal</th>
			<th colspan="3" class="thin-border">Pulang Awal</th>
			<th rowspan="2" class="thin-border">Terlambat</th>
			

			<th rowspan="2" class="thin-border">Lupa</th>
			<th rowspan="2" class="thin-border">Tugas Luar</th>
			<th rowspan="2" class="thin-border">Other</th>
			
			<th colspan="3" class="thick-border">Tidak Masuk</th>
				
			<th colspan="2" class="thin-border">Jumlah Hari Masuk</th>
			<th rowspan="2" class="thick-border">Jumlah Hari<br/>tidak Masuk</th>
			
			<th colspan="4">Nominal Uang Konsumsi</th>
		</tr>
		<tr>
			<th class="thin-border">Weekday</th>
			<th class="thin-border">Weekend</th>
			
			<th class="thin-border">Weekday<br/>&lt; 12</th>
			<th class="thin-border">Weekday<br/>&gt;= 12</th>			
			<th class="thin-border">Weekend</th>
			
			<th class="thin-border">Sakit</th>
			<th class="thin-border">Izin</th>
			<th class="thick-border">Alpha</th>
			
			<th class="thin-border">Weekday</th>
			<th class="thin-border">Weekend</th>
			
			<th class="thin-border">Weekday</th>
			<th class="thin-border">Weekend</th>
			<th class="thin-border">Pulang Awal</th>
			<th>Total</th>
		</tr>
		<?php $total=0;?>
		@foreach ($employees as $employee)	
			<tr class="absent-row">
				<td class="thin-border">{{ $employee->ssn or '-' }}</td>
				<td class="thick-border">{{ $employee->name or '-' }}</td>
				<!--<td>{{ $employee->department->name or '-' }}</td>-->
				<?php 
					$data = $employee->get_absence_data(9, 2014); 
					$total+=$data['konsumsi_total'];
				?>
				<td class="number thin-border">{{ $data['normal_weekday'] }}</td>
				<td class="number weekend thin-border">{{ $data['normal_weekend'] }}</td>	
				
				<td class="number thin-border">{{ $data['pulang_awal_weekday_before_12'] }}</td>
				<td class="number thin-border">{{ $data['pulang_awal_weekday'] }}</td>
				<td class="number weekend thin-border">{{ $data['pulang_awal_weekend'] }}</td>
				<td class="number thin-border">{{ $data['terlambat'] }}</td>				
				<td class="number thin-border">{{ $data['lupa'] }}</td>
				
				<td class="number thin-border">{{ $data['tugas_luar'] }}</td>
				<td class="number thin-border">{{ $data['other'] }}</td>
				
				<td class="number absent thin-border">{{ $data['sakit'] }}</td>
				<td class="number absent thin-border">{{ $data['izin'] }}</td>
				<td class="number absent thick-border">{{ $data['alpha'] }}</td>	
				
				<td class="number thin-border">{{ $data['masuk_weekday'] }}</td>
				<td class="number weekend thin-border">{{ $data['masuk_weekend'] }}</td>
				<td class="number absent thick-border">{{ $data['tidak_masuk'] }}</td>
								
				<td class="number thin-border">{{ number_format($data['konsumsi_weekday'], 0, ',', '.') }}</td>
				<td class="number thin-border">{{ number_format($data['konsumsi_weekend'], 0, ',', '.') }}</td>
				<td class="number thin-border">{{ number_format($data['konsumsi_pulang_awal'], 0, ',', '.') }}</td>
				<td class="number">{{ number_format($data['konsumsi_total'], 0, ',', '.') }}</td>
			</tr>	
		@endforeach
		<tr>
			<th colspan="20"></th>
			<th>{{ number_format($total, 0, ',', '.') }}</th>
		</tr>
	</table>
@stop
