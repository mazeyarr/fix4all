@extends('layout.app')

@section('title', 'Fix4all - Allround Klusbedrijf')

@section('content')
    <!-- Start Work -->
    <div class="container content-lg">
        <div class="row margin-b-40">
            <div class="col-sm-6">
                <h2>{{ $project->title }}</h2>
            </div>
        </div>
        <!--// end row -->
        <div class="row">
            <div class="col-sm-12 sm-margin-b-50">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="margin-b-20">
                            <div class="wow zoomIn" data-wow-duration=".3" data-wow-delay=".1s">
                                <img class="img-responsive" src="{{ asset('uploads/thumbnails/'  . $project->thumbnail) }}" alt="Latest Products Image">
                            </div>
                        </div>
                    </div>
                </div>
                <p>{{ $project->discription }}</p>
            </div>
        </div>
    </div>
    <!-- End Work -->
@endsection