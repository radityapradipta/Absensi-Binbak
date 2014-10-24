@extends('layouts.main')

@section('content')
<div class="page_title">
    View Allowance
</div>
<div class="page_content">	

    <div class="page_content_left">
        <!---------------- Da Text Field -------------------->

        <div class="content_head">
            Select Month
        </div>

        <div class="content_field">
            <select class="content_dropDown" id="allowance-month">
                <?php $month = array("January", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); ?>
                @for($i=1; $i<=12; $i++)
                @if(isset($parameters['month']) && $i==$parameters['month'])
                <option value="{{ $i }}" selected>{{ $month[$i-1] }}</option>
                @else
                <option value="{{ $i }}">{{ $month[$i-1] }}</option>
                @endif	
                @endfor
            </select>            
        </div>
        <!---------------- Da Text Field -------------------->

        <!---------------- Da Text Field -------------------->

        <div class="content_head">
            Select Unit
        </div>

        <div class="content_field">            
            <select class="content_dropDown" id="allowance-department">
                @foreach ($departments as $department)	
                @if(isset($parameters['id']) && $department['id']==$parameters['id'])
                <option value="{{ $department['id'] }}" selected>{{ $department['name'] }}</option>
                @else
                <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                @endif	
                @endforeach
            </select>           
        </div>
        <!---------------- Da Text Field -------------------->

        <div class="content_button">
            <button type="button" id="allowance-button" class="btn btn-primary-mod">Display Form</button>
        </div>
    </div>

    <div class="page_content_right">
        <!---------------- Da Text Field -------------------->

        <div class="content_head">
            Select Year
        </div>

        <div class="content_field">
            <select class="content_dropDown" id="allowance-year"/>
            @for($i=date('Y'); $i>=1990; $i--)	
            @if(isset($parameters['year']) && $i==$parameters['year'])
            <option value="{{ $i }}" selected>{{ $i }}</option>
            @else
            <option value="{{ $i }}">{{ $i }}</option>
            @endif	
            @endfor
            </select>
        </div>

        <!---------------- Da Text Field -------------------->
    </div>

    <div class="page_content_under">

        @if(!isset($valid))
        <div class="content_head">Please insert the option :)</div>
        @elseif(!$valid || (count($employees)<1))	
        <div class="content_head">No data found :(</div>
        @else
        <div class="content_head">
            DATA ABSENSI BINA BAKTI
            <br/>{{$month[$parameters['month']-1]}} {{$parameters['year']}}
        </div>

        <style>
            .allowance-table{
                font-size:0.8em;
                font-family: "Arial Narrow", Arial, sans-serif;
                border-collapse:collapse;				
            }
            .allowance-row:nth-child(odd){
                background-color:rgba(41, 128, 185,0.05);
            }
            .allowance-row:hover{
                background-color:rgba(41, 128, 185,1.0);
                color:white;
            }
            .allowance-table th{				
                color:black;
                font-weight:normal;
                padding:7.5px 3px 5px 3px;
                border-bottom:3px solid rgba(41, 128, 185,1.0);
                border-top:3px solid rgba(41, 128, 185,1.0);
            }			
            .allowance-table td{
                padding:5.5px 3px 3px 3px;
            }						
            .weekend{
                background-color:rgba(22, 160, 133,0.25);
            }
            .weekday{
                background-color:rgba(41, 128, 185,0.25);
            }
            .allowance{
                background-color:rgba(142, 68, 173,0.25);
            }
            .number{
                text-align:right;
                width:72px;
            }
            .thick-border{
                border-right:3px solid rgba(41, 128, 185,1.0);
            }
            .thin-border{
                border-right:1px solid rgba(41, 128, 185,1.0);
            }
        </style>

        <table class="allowance-table">
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
            <?php $total = 0; ?>
            @foreach ($employees as $employee)	
            <tr class="allowance-row">
                <td class="thin-border">{{ $employee->ssn or '-' }}</td>
                <td class="thick-border">{{ $employee->name or '-' }}</td>
                <!--<td>{{ $employee->department->name or '-' }}</td>-->
                <?php
                $data = $employee->get_absence_data($parameters['month'], $parameters['year']);
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

                <td class="number allowance thin-border">{{ $data['sakit'] }}</td>
                <td class="number allowance thin-border">{{ $data['izin'] }}</td>
                <td class="number allowance thick-border">{{ $data['alpha'] }}</td>	

                <td class="number thin-border">{{ $data['masuk_weekday'] }}</td>
                <td class="number weekend thin-border">{{ $data['masuk_weekend'] }}</td>
                <td class="number allowance thick-border">{{ $data['tidak_masuk'] }}</td>

                <td class="number thin-border">{{ number_format($data['konsumsi_weekday'], 0, ',', '.') }}</td>
                <td class="number thin-border">{{ number_format($data['konsumsi_weekend'], 0, ',', '.') }}</td>
                <td class="number thin-border">{{ number_format($data['konsumsi_pulang_awal'], 0, ',', '.') }}</td>
                <td class="number">{{ number_format($data['konsumsi_total'], 0, ',', '.') }}</td>
            </tr>	
            @endforeach
            <tr>
                <th colspan="20"></th>
                <th class="number">{{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </table>	
        @if(Auth::user()->role_id==1 || Auth::user()->role_id==3 || Auth::user()->role_id==4 )
        <div class="content_button">
            <button type="button" id="allowance-download-button" class="btn btn-primary-mod">Download</button>
        </div>
        @endif
        @endif

    </div>
</div>
@stop