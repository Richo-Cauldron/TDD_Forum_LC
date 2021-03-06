@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Thread</div>

                <div class="card-body">
                    <form method="POST" action="/threads">
                    	{{ csrf_field() }}
                    	<div class="form-group">
                            <label for="channel_id">Choose a Channel</label>
                            <select class="form-control" name="channel_id" id="channel_id">
                                <option value="">... choose one</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                    		<label for="title">Title</label>
                    		<input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" required>
                    	</div>
                    	<div class="form-group">
                    		<label for="body">Body</label>
                    		<textarea class="form-control" name="body" id="body" rows="8" required>{{ old('body') }}</textarea>
                    	</div>
                    	<button type="submit" class="btn btn-primary">Publish</button>
                        <br><br>
                        <div>
                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </form>
                    	</div>
                    	
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
