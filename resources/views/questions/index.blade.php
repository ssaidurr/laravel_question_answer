@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   @include ('layouts._messages')
                   @forelse ($questions as $question)
                        <div class="media post">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes_count }}</strong> {{ Illuminate\Support\str::plural('vote', $question->votes_count) }}
                                </div>                            
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answer_count }}</strong> {{ Illuminate\Support\str::plural('answer', $question->answers_count) }}
                                </div>                                                      
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a></h3>
                                    <div class="ml-auto">                                    
                                        @if(Auth::user()->id == $question->user_id)
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endif
                                        @if(Auth::user()->id == $question->user_id)
                                            <form class="form-delete" method="post" action="{{ route('questions.destroy', $question->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                        
                                    </div>
                                </div>
                                <p class="lead">
                                    Asked by 
                                    <a href="{{ $question->user->url }}">{{ $question->user->name }}</a> 
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                <div class="excerpt">{{ $question->excerpt(300) }}</div>
                            </div>                        
                        </div>
                        <hr>
                   @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> There are no questions available.
                        </div>
                    @endforelse

                    <div class="mx-auto pagination">
                        {{ $questions->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection