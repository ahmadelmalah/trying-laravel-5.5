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
            <form style="display:inline;" method="POST" action="{{ route('stack-makepublic', ['stack' => $stack->id]) }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default" type="submit">Make Public</button>
            </form>
        @endif
    </div>
</div>