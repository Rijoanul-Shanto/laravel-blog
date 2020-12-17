@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: white; padding: 23px;">
        <div class="rounded-lg">
            @auth
                <form action="{{ route('posts') }}" method="post" class="mb-4 form-group">
                    @csrf
                    <label for="body">Body</label>
                    <input name="title" type="text" class="form-control mb-4" placeholder="Title!">
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <textarea name="body" class="form-control mb-4" style="height: 150px" placeholder="Post something!"></textarea>
                    @error('body')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-primary">POST NOW</button>
                    </div>
                </form>
            @endauth

            @if ($posts->count())
                @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#">
                                    <img class="img-fluid rounded" src="http://placehold.it/550x200" alt="">
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->body}}</p>
                                <h3>Hello</h3>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <a href="/posts/{{ $post->id }}" class="btn btn-primary">Read More &rarr;</a>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Posted <span>{{ $post->created_at->diffForHumans() }}</span> By <b><span>{{ $post->user->name }}</span></b>
                    </div>
                </div>
                @endforeach

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>

            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection