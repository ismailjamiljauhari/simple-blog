@extends('frontend.main', [
    'title' => 'Post',
    'withHeader' => true,
]);
@section('content')
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @foreach ($posts as $post)
            <!-- Post preview-->
            <div class="post-preview">
                <a href="{{ route('post.detail', $post->slug )}}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!">{{ $post->user->name }}</a>
                    on {{ $post->publish_at->format('M d, Y H:i:s')}}
                </p>
                <p class="post-meta">
                    {{ $post->view_count }} kali dilihat
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
            @endforeach
        </div>
    </div>
</div>
@endsection