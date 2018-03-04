@extends('layout.auth-layout')

@section('content')
    @if(!empty($errors->first()))
        @foreach ($errors->all() as $error)
            <div class="row">
                <div class="col-md-10 col-md-push-1">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @elseif(Session::has('success'))
        <div class="row">
            <div class="col-md-10 col-md-push-1">
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            </div>
        </div>
        <hr>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-push-1">
            {{ Form::open(['route' => 'user_about_save']) }}
            <div class="form-group">
                {!! Form::textarea('about', $about, ['class' => 'form-control', 'placeholder' => 'Vertel wat over Fix4all']) !!}
            </div>
            <button class="btn btn-success btn-block">Opslaan</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection