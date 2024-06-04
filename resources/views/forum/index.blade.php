@extends('layouts.app')

@section('judul')
Forum SneakyBites
@endsection

@section('content')
    <div class="container">
        <br>
        @if(Auth::guest())
        <div class="d-flex">
            <a href="{{ route('login') }}"><i class="=fa fa-sign-in"></i>Login</a>
            <span style="padding-right: 5px;"></span><p> to create and edit your comment</p>
        </div>
        @else
            <form action="{{ route('forum.create') }}">
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        @endif
        <br>
        @foreach ($forumPosts as $fp)
            <div class="card mb-4">
                <div class="card-header">{{ $fp->user->name }} posted:</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route( 'forum.show', $fp->id ) }}">{{ $fp->title }}</a>
                    </h5>
                    <p class="card-text">{{ $fp->body }}</p>
                    @if(Auth::guest())
                        <form action="{{ route( 'login' ) }}">
                            <button type="submit" class="btn btn-primary btn-sm">Login</button>
                        </form>
                    @else
                        <div class="d-flex">
                            <form action="{{ route('forum.edit', $fp->id ) }}">
                                <button type="submit" class="btn btn-primary btn-sm">Edit Post</button>
                            </form>
                            <span style="padding-right: 30px;"></span>
                            <a href="#" class="btn btn-danger btn-sm fw-bold"
                                onclick="event.preventDefault();document.getElementById('confirm_delete-{{ $fp->id }}').submit(); return confirm('Anda yakin ingin menghapus?');">
                                Delete Post
                                <form id="confirm_delete-{{ $fp->id }}" method="POST" action="{{ route('forum.delete', $fp->id) }}" class="d-none">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete Forum</button>
                                </form>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $fp->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        @endforeach
    </div>
@endsection