@if($reveal == true)
<div class="input-group">
    <input type="text" name="UserResponse" class="form-control" 
    placeholder="Your Answer .." value="{{ $answer }}" disabled>
    <span class="input-group-btn">
        <a href="{{ route('practice', ['stack' => $stack->id]) }}" class="btn btn-primary">Ahh OK!</a>
    </span>
</div>
@else
<div class="input-group">
    <input type="text" name="UserResponse" class="form-control" 
    placeholder="Your Answer .." value="{{ $answer }}" autofocus="autofocus" autocomplete="off" required>
    <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Submit & Next</button>
    </span>
</div>
@endif