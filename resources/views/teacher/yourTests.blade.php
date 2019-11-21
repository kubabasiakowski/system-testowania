@extends('layouts.teacher')
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

                    	<table class="table" width="808" align="left" height="198" valign="top" cellspacing="0" cellpadding="0" >
							<thead>
								<th><b>Lp</b></th>
								<th><b>Przedmiot</b></th>
								<th><b><b>Liczba Pytań</b></th>
								<th><b>Czas trwania</b></th>
								<th><b>Hasło do testu</b></th>
								<th><b>Czy aktywny</b></th>
								<th><b>Aktywuj test</b></th>
							</thead>

							<tbody>
								@foreach($testTemplates as $testTemplate)
								 <!-- Single test -->
									<tr>
										<td><?php $i=$i+1; echo $i ?></td>
										<td>{{ $subjects->find($testTemplate->subject_id)->name }}</td>
										<td>{{ $testTemplate->number_of_questions }}</td>
										<td>{{ $testTemplate->time }} min</td>
										<td>{{ $testTemplate->testPassword }}</td>
										<td>@if($testTemplate->is_active=='true' || $testTemplate->is_active=='1' ){{'Aktywny'}}@else{{'Niektywny'}}@endif</td>
										<td>
											@if($testTemplate->is_active=='false' || $testTemplate->is_active=='0')
											<a href="{{ url('yourTests', $testTemplate->id) }}" class="btn btn-primary">Aktywwuj test</a>
			                                @else
			                                <a href="{{ url('yourTests', $testTemplate->id) }}" class="btn btn-primary">Dezaktywuj test</a>
			                                @endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>

						<div class="text-center">
							{!! $testTemplates->links(); !!}
						</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection