@if($reveal == true)
<div class="input-group">
    @foreach ($answer as $option=>$value)
        <input type="checkbox" name="option[]" @if($value == "selected")checked @endif disabled>
        <label for="option[]">{{ $option }}</label>
        <br>
    @endforeach
    <a href="{{ route('practice', ['stack' => $stack->id]) }}" class="btn btn-primary">Ahh OK!</a>
</div>
@else
<div class="input-group">
    @foreach ($answer as $option=>$value)
        <input type="checkbox" name="option[]">
        <label for="option[]">{{ $option }}</label>
        <br>
    @endforeach
    <button class="btn btn-primary" type="submit">Submit & Next</button>
</div>
@endif