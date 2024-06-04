@extends('layouts.app')

@section('judul')
Forum SneakyBites
@endsection

@section('content')
    <div class="container">    
        <div class="card mb-4">
            <div class="card-header">Edit Post</div>
        <div class="card-body">
            <form action="{{ route( 'forum.update', $forum->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $forum->title }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="5" required>{{ $forum->body }}</textarea>
                    @error('body')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <!-- <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" enctype="multipart/form-data" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <img src="{{asset('storage/images/' . $forum->image)}}" alt="">
                </div> -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection