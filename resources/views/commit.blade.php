@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h3>COMMIT N<sup>o</sup>: {{$list->commit}}</h3>
                <br><br><br>
                @foreach ($tasks as $item)
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
