@extends('layouts.teacher')
@section('pageContent')

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

@if(Session::has('test_added'))
    <div class='alert alert-success panel-body'>
        {{ Session::get('test_added') }}
    </div>
@elseif(Session::has('wrongQuestionNumber'))
    <div class='alert alert-danger panel-body'>
        {{ Session::get('wrongQuestionNumber') }}
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Utwórz test</strong>
                </div>

                <div class="panel-body">
                    {!!  Form::open(['url'=>'createTest','class'=>'form-horizontal', 'method'=>"POST", 'url'=>action('TeacherController@addTest')]) !!}
                    <div class="form-group">
                        <table class="table" align="left" cellspacing="0" cellpadding="0">
                           
                            <tr>
                                <td colspan="2">Dodaj nowy test poprzez wybór jego parametrów,a następnie przejdź do zakładki "Stworzone testy" aby go aktywować. </td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('number_of_questions','Liczba pytań: ') !!}</td>
                                    <td class="col-md-8">{!! Form::text('number_of_questions',null,['class'=>'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('time','Czas trwania testu (minut): ') !!}</td>
                                    <td class="col-md-8">{!! Form::text('time',null,['class'=>'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('subject','Przedmiot: ') !!}</td>
                                <td class="col-md-8">
                                    {!! Form::select('subject_id', $subjects, null) !!}
                                </td>
                                {!! Form::hidden('user_id', Auth::user()->id) !!}
                                {!! Form::hidden('is_active', 'false') !!}
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('testPassword','Hasło do testu: ') !!}</td>
                                    <td class="col-md-8">{!! Form::password('testPassword',null,['class'=>'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::label('testPasswordConfirm','Powtórz hasło: ') !!}</td>
                                    <td class="col-md-8">{!! Form::password('testPassword_confirmation',null,['class'=>'form-control']) !!}</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 control-label">{!! Form::submit('Dodaj test',['class'=>'btn btn-primary']) !!}</td>
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