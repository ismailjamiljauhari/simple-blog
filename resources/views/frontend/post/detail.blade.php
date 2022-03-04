@extends('frontend.main', [
    'title' => $object->title,
    'withHeader' => false,
]);
@section('header')
<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $object->title }}</h1>
                    <h2 class="subheading">{{ $object->category }}</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">{{ $object->user->name }}</a>
                        on {{ $object->publish_at->format('M d, Y H:i:s')}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection
@section('content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    {!! $object->content !!}
                </div>
            </div>
        </div>
    </article>
@endsection