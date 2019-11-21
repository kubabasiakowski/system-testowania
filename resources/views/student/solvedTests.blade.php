@extends('layouts.student')
@section('pageContent')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Twoje testy</strong></div>
                	<div class="panel-body">
                		<?php
							$i=0;
						?>
						@if($countSolvedTests>0)
						<table class="table" width="808" align="left" height="198" valign="top" cellspacing="0" cellpadding="0" >
							<thead>
								<th><b>Lp</b></th>
								<th><b>Przedmiot</b></th>
								<th><b><b>Liczba punktów</b></th>
								<th><b>Ocena</b></th>
							</thead>

							<tbody>
								@foreach($solvedTests as $solvedTest)
									<!-- Single test -->
									<tr>
										<td><?php $i=$i+1; echo $i; ?></td>
										<td>{{ $solvedTest->test_template->subject->name }}</td>
										<td>{{ $solvedTest->points }}</td>
										<td>{{ $solvedTest->mark }}</td>
										<td><a href="{{ url('solvedTests', $solvedTest->id) }}" class="btn btn-primary">Pokaż szczegóły</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<i><h1 class="text-center">Brak testów.</h1></i>
						@endif
						<div class="text-center">
							{!! $solvedTests->links(); !!}
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection