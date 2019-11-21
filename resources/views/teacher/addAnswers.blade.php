@extends('layouts.teacher')
@section('pageContent')
<div class="container">

    <div class="panel-body">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
         @endif
    </div>


    @if(Session::has('no_correct'))
        <div class='alert alert-danger panel-body'>
            {{ Session::get('no_correct') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Dodaj odpowiedzi do pytania</strong>
                </div>
                
                <div class="panel-body">
                    {!!  Form::open(['url'=>'questions','class'=>'form-horizontal', 'method'=>"GET", 'url'=>action('TeacherController@addAnswers')]) !!}
                    <div class="form-group">
                        <table class="table" align="left" cellspacing="0" cellpadding="0">

                            <tr>
                                <td class="col-md-8" colspan="3">Dodaj odpowiedzi do pytania. Minimalna liczba odpowiedzi to 2. Nie musisz wypełniać wszystkich pól, jeśli liczba odpowiedzi jest mniejsza niż liczba pól, zbędne pola pozostaw puste.</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('question_content','Treść pytania: ') !!}</td>
                                <td class="col-md-8">{{ $question['question_content'] }}</td>
                                <td class="col-md-offset-2">Zaznacz poprawne odpowiedzi</td>
                            </tr>
                            {!! Form::hidden('question_id', $id) !!}
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('answer1','Odpowiedź 1: ') !!}</td>
                                <td class="col-md-8">{!! Form::text('answer1',null,['class'=>'form-control']) !!}</td>
                                <td class="col-md-offset-2">{!! Form::checkbox('answer1_isCorrect') !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('answer3','Odpowiedź 2: ') !!}</td>
                                <td class="col-md-8">{!! Form::text('answer2',null,['class'=>'form-control']) !!}</td>
                                <td class="col-md-offset-2">{!! Form::checkbox('answer2_isCorrect') !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('answer3','Odpowiedź 3: ') !!}</td>
                                <td class="col-md-8">{!! Form::text('answer3',null,['class'=>'form-control']) !!}</td>
                                <td class="col-md-offset-2">{!! Form::checkbox('answer3_isCorrect') !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('answer4','Odpowiedź 4: ') !!}</td>
                                <td class="col-md-8">{!! Form::text('answer4',null,['class'=>'form-control']) !!}</td>
                                <td class="col-md-offset-2">{!! Form::checkbox('answer4_isCorrect') !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('answer5','Odpowiedź 5: ') !!}</td>
                                <td class="col-md-8">{!! Form::text('answer5',null,['class'=>'form-control']) !!}</td>
                                <td class="col-md-offset-2">{!! Form::checkbox('answer5_isCorrect') !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('answer6','Odpowiedź 6: ') !!}</td>
                                <td class="col-md-8">{!! Form::text('answer6',null,['class'=>'form-control']) !!}</td>
                                <td class="col-md-offset-2">{!! Form::checkbox('answer6_isCorrect') !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::submit('Dodaj odpowiedzi',['class'=>'btn btn-primary']) !!}</td>
                            </tr>
                            {!! Form::close() !!}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection