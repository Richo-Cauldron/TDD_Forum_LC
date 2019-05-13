@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <br>
            @foreach ($thread->replies as $reply)
                @include('threads._reply')
            @endforeach
            
            @if (auth()->check())
                <form method="POST" action="{{ $thread->path().'/replies' }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" rows="5" placeholder="Have something to say">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
                @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> in this discussion to participate</p>
            @endif
               
        </div>
    </div>
</div>
@endsection
