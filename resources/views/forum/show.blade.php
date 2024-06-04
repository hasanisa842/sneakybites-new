@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp

@section('judul')
Forum - "{{ $shf->title }}"
@endsection

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">{{ $shf->user->name }} posted on {{ $shf->created_at->format('d M Y, H:i') }} with {{ $shf->comments->count() }} replies:</div>
            <div class="card-body">
                <h5 class="card-title">
                    {{ $shf->title }}
                </h5>
                <p class="card-text">{{ $shf->body }}</p>
            </div>
        </div>
        @if(Auth::guest())
            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                <div class="d-flex flex-start w-100">
                    <img class="rounded-circle shadow-1-strong me-3" src="https://th.bing.com/th/id/OIP.ItvA9eX1ZIYT8NHePqeuCgAAAA?rs=1&pid=ImgDetMain" alt="avatar" width="40"height="40" />
                    <div class="form-outline w-100 d-flex">
                        <a href="{{ route('login') }}"><i class="=fa fa-sign-in"></i>Login</a>
                        <span style="padding-right: 5px;"></span><p>to Comment</p>
                    </div>
                </div>
            </div>
        @else
        <form action="{{ route('comment.create', $shf->id) }}" method="POST">
            @csrf
            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                <div class="d-flex flex-start w-100">
                    <img class="rounded-circle shadow-1-strong me-3" src="https://th.bing.com/th/id/OIP.ItvA9eX1ZIYT8NHePqeuCgAAAA?rs=1&pid=ImgDetMain" alt="avatar" width="40"height="40" />
                    <div class="form-outline w-100">
                        <textarea class="form-control" name="content" rows="4" style="background: #fff;"></textarea>
                        <input type="hidden" name="forum_id" value="{{ $shf->id }}">
                    </div>
                </div>
                <div class="float-end mt-2 pt-1">
                    <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                </div>
            </div>
        </form>
        @endif
    </div>
    <br><br>
    <div class="container">
        @forelse($shf->comments as $comment)
        <div class="card mb-4">
            <div class="card-header">{{ Carbon::parse($comment->created_at)->diffForHumans() }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://th.bing.com/th/id/OIP.ItvA9eX1ZIYT8NHePqeuCgAAAA?rs=1&pid=ImgDetMain" alt="Profile" width="100%">
                        <br>
                        <div style="text-align: center;">
                            <br>
                            <b>{{ $comment->user->name }}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{ $comment->content }}
                    </div>
                </div>
                <!-- <div class="float-end mt-2 pt-1">
                    <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                </div> -->
            </div>
        </div>
        @empty

        <p>No Comments</p>

        @endforelse
    </div>
@endsection