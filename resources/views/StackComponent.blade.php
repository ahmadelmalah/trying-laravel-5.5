<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $stack->name }}</h3>
    </div>
    <div class="panel-body">
    {{ $stack->description }}
    </div>
    <div class="panel-footer">
        <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-default">View Stack Status</a>
    </div>
</div>