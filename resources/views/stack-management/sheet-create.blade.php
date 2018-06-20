@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creating a new sheet</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sheet-store', ['stack' => $stack->id]) }}">
                        {{ csrf_field() }}
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sheet details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" name="question" class="form-control" 
                                    placeholder="Sheet question .." autofocus="autofocus"  required>
                                </div>
                                <!-- Answer part -->
                                <div class="form-group">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="options" id="optOpen" autocomplete="off" checked onchange="activateOpenText()"> Open Text
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" id="optMulti" autocomplete="off" onchange="activateMulti()"> Multiple Choice
                                        </label>
                                    </div>
                                </div>
      
                                <!-- OpenText Panel -->
                                <div class="form-group" id="panelOpenText">
                                    <input type="text" name="answer" class="form-control" 
                                    placeholder="Sheet answer ..">
                                </div>
                                <!-- End of OpenText Panel -->
                                <!-- MultipleChoice Panel -->
                                <div class="form-group form-inline" id="panelMulti" style="display: none;">
                                <p><button type="button" class="btn btn-default" onclick="addMulti()">More fields</button></p>
                                    <p>
                                    <input type="text" name="multianswer[]" class="form-control">
                                    <select name="multianswercheck[]" class="form-control"><option value="selected" selected>Must be selected</option><option value="unselected">Must be unselected</option></select> 
                                    </p>
                                </div>
                                <!-- End of MultipleChoice Panel -->

                                <!-- End of answer part -->
                            </div>
                            <div class="panel-footer">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Submit Sheet</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
i=1;
function activateOpenText(){
    $("#panelOpenText").show()
    $("#panelMulti").hide()
    
}
function activateMulti(){
    $("#panelOpenText").hide()
    $("#panelMulti").show()
}
function addMulti(){
    var appendFields = '<p>';
    appendFields += '<input type="text" name="multianswer[]" class="form-control">';
    appendFields += '<select name="multianswercheck[]" class="form-control"><option value="selected" selected>Must be selected</option><option value="unselected">Must be unselected</option></select>';
    appendFields += '</p>';
    $("#panelMulti").append(appendFields);
    i++;
}
</script>

@endsection
