@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h6>Modifier la tache</h6></div>

                <div class="card-body">

                    <form method="POST" action="{{route('update.post',$task->id)}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nom de la tache: </label>
                                <input class="form-control" type="text" name="name" value="{{$task->name}}" required>
                            </div>
                            @php
                                $date = date('Y-m-d\TH:i', strtotime($task->end_task))
                            @endphp
                            <div class="form-group col-md-6">
                                <label for="endTaskDate">Fin de la tache: </label>
                                <input class="form-control" id="endTaskDate" value="{{$date}}" type="datetime-local" name="endTaskDate" required>
                            </div>
                            
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Déscription: </label>
                            <textarea class="form-control" type="text" name="description">{{$task->description}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mb-2">Modifier la tache</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
