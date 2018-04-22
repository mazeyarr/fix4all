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
            {{ Form::open(['route' => 'user_meta_save', 'id' => 'form']) }}
            <h3>Keywords</h3>
            <div class="form-group">
                {!! Form::text('keywords', $meta->keywords, ['id' => 'keywords', 'class' => 'form-control', 'placeholder' => 'Woorden waar deze site door gevonden kan worden...']) !!}
            </div>
            <h3>Onderwerp</h3>
            <div class="form-group">
                {!! Form::text('subject', $meta->subject, ['id' => 'subject', 'class' => 'form-control', 'placeholder' => 'Onderwerp van de site']) !!}
            </div>
            <h3>Omscrhijving</h3>
            <div class="form-group">
                {!! Form::textarea('description', $meta->description, ['id' => 'discription', 'class' => 'form-control', 'placeholder' => 'Omschrijving van de site in 255 woorden']) !!}
            </div>
            <button class="btn btn-success btn-block" data-form="form-upload">Opslaan</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection