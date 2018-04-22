<!-- Start Work -->
<div id="work">
    <div class="container content-lg">
        <div class="row margin-b-40">
            <div class="col-sm-6">
                <h2>Recente Opdrachten</h2>
            </div>
        </div>
        <!--// end row -->
        <div class="row">
            @foreach($projects as $project)
                <div class="col-sm-4 sm-margin-b-50">
                    <div class="margin-b-20">
                        <div class="wow zoomIn" data-wow-duration=".3" data-wow-delay=".1s">
                            <img class="img-responsive" src="{{ asset('uploads/thumbnails/'  . $project->thumbnail) }}" alt="Latest Products Image">
                        </div>
                    </div>
                    <h4><a href="#">{{ $project->title }}</a> <span class="text-uppercase margin-l-20"></span></h4>
                    <p>{{ $project->discription }}</p>
                    {{--<a class="link" href="#">Lees meer</a>--}}
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Work -->