@extends('layouts.student')
@section('pageContent')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Lista dostepnych testów</strong></div>
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
							</thead>

							<tbody>
								@foreach($activeTests as $activeTest)
									<!-- Single test -->
									<tr>
										<td><?php $i=$i+1; echo $i; ?></td>
										<td>{{ $subjects->find($activeTest->subject_id)->name }}</td>
										<td>{{ $activeTest->number_of_questions }}</td>
										<td>{{ $activeTest->time }} min</td>
										<td><a href="{{ url('availableTests', $activeTest->id) }}" class="btn btn-primary">Przejdz do testu</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<i><h1 class="text-center">Brak dostepnych testów.</h1></i>
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