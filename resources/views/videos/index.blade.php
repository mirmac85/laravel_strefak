@extends('master')
@section('content')


<div class="videos-header card">
    <h2>Najnowsze filmy</h2>
</div>


@if(Session::has('video_created')) 
  <div class="alert alert-success card">
      {{ Session::get('video_created') }}
  </div>  
@endif


<div class="row">

    @foreach ($videos as $video)
    
      <!-- Single video -->
      <div class="col-xs-12 col-md-6 col-lg-4 single-video">
          <div class="card">

              <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="{{$video->url}}?showinfo=0" frameborder="0" allowfullscreen></iframe>
              </div>
              <div class="card-content">
                  <a href="{{url('videos', $video->id)}}">
                      <h4>{{$video->title}}</h4>
                  </a>
                  <p>{{ str_limit($video->description, 2) }}</p>
                  <span class="upper-label">Dodał</span>
                  <span class="video-author">{{ $video->user->name }}</span>
              </div>

          </div>
      </div>

    @endforeach

</div>



@endsection
