@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h6>Créer une tache</h6></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('add.task')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nom de la tache: </label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="endTaskDate">Fin de la tache: </label>
                                <input class="form-control" id="endTaskDate" type="datetime-local" name="endTaskDate" required>
                            </div>
                            
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Déscription: </label>
                            <textarea class="form-control" type="text" name="description"></textarea>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mb-2">Creer la tache</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <br>
                <h3>TACHES EN COURS</h3>
                @foreach ($tasks as $item)
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <a href="{{route('update.task',$item->id)}}">modifier</a>
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">{{$item->description}}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <span style="font-size: 12px;">Date de Creation: {!! htmlspecialchars_decode( $item->created_at->format('l j<\s\up>S</\s\up> F Y h:i:s A')) !!}</span>
                                </div>
                                <div class="col-md-6">
                                    <span style="font-size: 12px;">Date de Cloture: {!! htmlspecialchars_decode( $item->end_task->format('l j<\s\up>S</\s\up> F Y h:i:s A') ) !!}</span>
                                </div>
                            </div>
                            @if($item->completed != 0)
                                Status: <a href="{{route('incomplete.task',$item->id)}}" class="btn btn-success btn-sm">Complet</a>
                            @else
                                Status: <a href="{{route('completed.task',$item->id)}}" class="btn btn-danger btn-sm">Incomplet</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <br>
                <h3>TACHES COMPLETES</h3>
                @foreach ($completedTasks as $item)
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">{{$item->description}}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <span style="font-size: 12px;">Date de Creation: {!! htmlspecialchars_decode( $item->created_at->format('l j<\s\up>S</\s\up> F Y h:i:s A')) !!}</span>
                                </div>
                                <div class="col-md-6">
                                    <span style="font-size: 12px;">Date de Cloture: {!! htmlspecialchars_decode( $item->end_task->format('l j<\s\up>S</\s\up> F Y h:i:s A') ) !!}</span>
                                </div>
                            </div>
                            @if($item->completed != 0)
                                Status: <a href="{{route('incomplete.task',$item->id)}}" class="btn btn-success btn-sm">Complet</a>
                            @else
                                Status: <a href="{{route('completed.task',$item->id)}}" class="btn btn-danger btn-sm">Incomplet</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <br>
                <h3>TACHES ACHEVEES</h3>
                @foreach ($endTasks as $item)
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">{{$item->description}}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <span style="font-size: 12px;">Date de Creation: {!! htmlspecialchars_decode( $item->created_at->format('l j<\s\up>S</\s\up> F Y h:i:s A')) !!}</span>
                                </div>
                                <div class="col-md-6">
                                    <span style="font-size: 12px;">Date de Cloture: {!! htmlspecialchars_decode( $item->end_task->format('l j<\s\up>S</\s\up> F Y h:i:s A') ) !!}</span>
                                </div>
                            </div>
                            Status: <button class="btn btn-secondary btn-sm">{{$item->completed == 0 ? 'Incomplet': 'Complet'}}</button>
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
