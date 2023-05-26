<div class="media post">
    @include('shared._vote',[
        'model' => $answer,
        'name' => 'answer',
        'firstURISegment' => 'answers'
    ])
    <div class="media-body">
        {!! $answer->body !!}
        <div class="row">
            <div class="col-4">
                <div class="ml-auto">
                    @if(Auth::user()->id == $answer->user_id)
                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                    @endif
                    @if(Auth::user()->id == $answer->user_id)
                    <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                @include('shared._author',[
                    'model' => $answer,
                    'label' => 'answered'
                ])
            </div>
        </div>                            
    </div>
</div>