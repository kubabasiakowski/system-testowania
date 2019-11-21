@extends('layouts.teacher')
@section('pageContent')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Lista aktywnych testów</strong></div>
                	<div class="panel-body">
                		<?php
							$i=0;
						?>
						@if($countActiveTest>0)
						<table class="table" width="808" align="left" height="198" valign="top" cellspacing="0" cellpadding="0" >
							<thead>
								<th><b>Lp</b></th>
								<th><b>Przedmiot</b></th>
								<th><b><b>Liczba Pytań</b></th>
								<th><b>Czas trwania</b></th>
								<th><b>Hasło do testu</b></th>
								<th><b>Czy aktywny</b></th>
							</thead>

							<tbody>
								@foreach($activeTests as $activeTest)
									<!-- Single test -->
									<tr>
										<td><?php $i=$i+1; echo $i; ?></td>
										<td>{{ $subjects->find($activeTest->subject_id)->name }}</td>
										<td>{{ $activeTest->number_of_questions }}</td>
										<td>{{ $activeTest->time }} min</td>
										<td>{{ $activeTest->testPassword }}</td>
										<td>@if($activeTest->is_active=='true' || $activeTest->is_active=='1' ){{'Aktywny'}}@else{{'Niektywny'}}@endif</td>
										
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<i><h1 class="text-center">Brak aktywnych testów.</h1></i>
						@endif
						<div class="text-center">
							{!! $activeTests->links(); !!}
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection