<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $stack->name }}</h3>
    </div>
    <div class="panel-body">
    {{ $stack->description }}
    </div>
    <div class="panel-footer">
        <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-default">View Stack Status</a>
        @if($stack->type != 3 && $stack->created_by == Auth()->User()->id)
            <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-default">Make Public</a>
        @endif
    </div>
</div>