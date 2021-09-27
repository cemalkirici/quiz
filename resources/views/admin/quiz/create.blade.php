<x-app-layout>
    <x-slot name="header"> Create Quiz </x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('quizzes.store')}}">
                @csrf
                <div class="form-group">
                    <label>Quiz Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div><br>
                <div class="form-group">
                    <label>Quiz Description</label>
                    <textarea name="description" class="form-control" rows="4">{{old('description')}}</textarea>
                </div><br>
                <div class="form-group">
                    <input id="isFinished" @if(old('finished_at')) checked @endif type="checkbox">
                    <label>End Date ?</label>
                </div><br>
                <div id="finishedInput" @if(!old('finished_at')) style="display:none" @endif class="form-group">
                    <label>End Date</label>
                    <input type="datetime-local" name="finished_at" width="100%" value="{{old('finished_at')}}">
                </div><br>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block" style="width: 100%"> Create Quiz</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="js">
        <script>
        $('#isFinished').change(function() {
            if($('#isFinished').is(':checked')){
            $('#finishedInput').show();
        }else {
                $('#finishedInput').hide();
            }
        });
        </script>
    </x-slot>
</x-app-layout>
