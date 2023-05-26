<span class="text-muted">{{ $label ." ". $model->created_date }}</span>
<div class="media mt-2">
    <div class="media-body mt-1">
        <a href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </div>
</div>