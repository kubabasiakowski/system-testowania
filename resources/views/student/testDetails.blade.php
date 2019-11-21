@extends('layouts.student')
@section('pageContent')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ $solvedTest->test_template->subject->name }}</strong></div>
                	<div class="panel-body">
                		<?php
							$i=0;
						?>
						<table class="table" width="808" align="left" height="198" valign="top" cellspacing="0" cellpadding="0" >
							<thead>
								<th><b>Lp</b></th>
								<th><b>Pytanie</b></th>
								<th><b><b>Maksymalna liczba punktów</b></th>
								<th><b>Uzyskane punkty</b></th>
							</thead>

							<tbody>
								@foreach($questions as $question)
									<tr>
										<td><?php $i=$i+1; echo $i; ?></td>
										<td>{{ $question->question_content }}</td>
										<td>{{ $question->points }}</td>
										<td>{{ $userPoints[$i-1] }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div align='center'>
		                    <td><a href="{{ url('solvedTests') }}" class="btn btn-primary">Wróć do listy testów</a></td>
		                </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection