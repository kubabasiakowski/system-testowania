@extends('layouts.student')
@section('pageContent')

</div>
	<div class="container">
	    <div class="row">

	        <div class="col-md-9 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h2>Twój wynik</h2></div>
		                <div class="panel-body">
							<table class="table" align="left" cellspacing="0" cellpadding="0">
		                        <tr>
		                            <td>Przedmiot:</td><td><b>{{ $subject->name }}</b></td>
		                        </tr>
		                        <tr>
		                            <td>Uzyskane punkty:</td><td>{{ $testPoints }} / <b>{{ $maxTestPoints }}</b></td>
		                        </tr>
		                        <tr>
		                            <td>Procentowy wynik:</td><td><b>{{ $percentage }}</b></td>
		                        </tr>
		                        <tr>
		                            <td>Ocena:</td><td><b>{{ $mark }}</b></td>
		                        </tr>
		                        </table>
		                        <div align='center'>
		                            <td><a href="{{ url('solvedTests') }}" class="btn btn-primary">Przejdź do strony rozwiązanych testów</a></td>
		                        </div>
						</div>
				</div>
	        </div>

	        
	</div>
</div>

@endsection