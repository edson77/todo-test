@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h6>LISTE DES COMMITS</h6></div>

                <div class="card-body">
                    @foreach($lists as $item)
                        <a href="{{route('commit',$item->id)}}">{{$item->commit}} &nbsp;#{{$item->id}}</a>
                        <p class="ml-auto" style="font-size: 12px;">{{$item->created_at->format('Y/m/d H:i')}}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
