@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">{{ $post->title }}
        </h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">Blog Post</li>
        </ol>

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Preview Image -->
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

                <hr>

                <div class="row">
                    <div class="col-lg-8" style="padding-top: 9px">
                        <!-- Date/Time -->
                        Posted <span>{{ $post->created_at->diffForHumans() }}</span> By <b><span>{{ $post->user->name }}</span></b>
                    </div>
                    @if ($post->ownedBy(auth()->user()))
                        <div class="col-lg-3">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <button class="btn btn-success btn-m rounded-1"  style="margin-left: 130px !important;" type="button" data-toggle="modal" data-target="#updateModal" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                </li>
                            </ul>
                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('post.update', $post) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <div class="form-outline">
                                                    <label class="form-label" for="typeText">Title</label>
                                                    <input type="text" id="newTitle" name="newTitle" class="form-control" value="{{ $post->title }}"/>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-outline">
                                                    <label class="form-label" for="textAreaExample">Post Body</label>
                                                    <textarea class="form-control" id="newBody" name="newBody" rows="4">{{ $post->body }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <ul class="list-inline m-0">
                                <form action="{{ route('post.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-m rounded-1" type="button" data-toggle="modal" data-target="#deleteModal" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                    </li>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content alert-danger" style="background-color: #f8d7da">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div style="padding-top: 26px; padding-left: 39px">
                                                            <strong>Warning!</strong> Post will be deleted!
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    @endif
                </div>

                <hr>

                <!-- Post Content -->
                <p class="lead">{{ $post->body }}</p>


                <hr>

                <!-- Comments Form -->
                @auth
                    <div class="card my-4">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form action="/posts/{{ $post->id }}/comments" method="POST">
                                @csrf

                                <div class="form-group">
                                    <textarea name="body" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <!-- Single Comment -->
                @if ($comments->count())
                    @foreach ($comments as $comment)
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-10 col-md-11">
                                        <div>
                                            <div class="mic-info">
                                                By:  <b><span>{{ $post->user->name }}</span></b> <span>{{ $post->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            {{ $comment->body }}
                                        </div>
                                        @if ($post->ownedBy(auth()->user()))
                                            <div class="action">
                                                <button type="button" class="btn btn-primary" style="padding: 1px 7px" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" style="padding: 1px 7px" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @endforeach

                    @else
                        <p>There are no comments</p>
                @endif

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="inpug-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature
                        the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection