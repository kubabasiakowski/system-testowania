@extends('layouts.teacher')
@section('pageContent')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Panel użytkownika</strong>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table" align="left" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>Imie:</td><td><b>{{Auth::user()->name}}</b></td>
                        </tr>
                        <tr>
                            <td>Nazwisko:</td><td><b>{{Auth::user()->surname}}</b></td>
                        </tr>
                        <tr>
                            <td>Status konta:</td><td><b>{{Auth::user()->status}}</b></td>
                        </tr>
                        <tr>
                            <td>E-Mail:</td><td><b>{{Auth::user()->email}}</b></td>
                        </tr>
                        <tr>
                                <td>Nr indeksu:</td><td><b>@if(Auth::user()->status=='student'){{Auth::user()->index_number}}@else{{'Nie dotyczy'}}@endif</b></td>
                        </tr>
                        <tr>
                            <td><input type="button" value="Zmień hasło" id="passwordChange" class="btn btn-primary"></td><td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection