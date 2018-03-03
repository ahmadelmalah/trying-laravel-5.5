<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $stack->name }}</h3>
    </div>
    <div class="panel-body">
    {{ $stack->description }}
    </div>
    <div class="panel-footer">
        @can('use-stack', $stack)
        <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-info">View Stack Status</a>
        <form style="display:inline;" method="POST" action="{{ route('stack-unsubscribe', ['stack' => $stack->id]) }}"
            onsubmit="return confirm('Unsubscribe from this stack?');">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" type="submit">Unsubscribe</button>
        </form>
        @else
            <form style="display:inline;" method="POST" action="{{ route('stack-subscribe', ['stack' => $stack->id]) }}"
                onsubmit="return confirm('Subscribe to this stack?');">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success" type="submit">Subscribe</button>
            </form>
        @endcan
        @if($stack->type == 2 && $stack->created_by == Auth()->User()->id)
            <form style="display:inline;" method="POST" action="{{ route('stack-makepublic', ['stack' => $stack->id]) }}"
                onsubmit="return confirm('After publishing the stack you will not be able to return it to private, continue?');">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary" type="submit">Publish on Marketplace</button>
            </form>
        @endif
    </div>
</div>