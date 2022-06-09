@extends('layouts.app')
<script>
    $("#ModalExample").modal("show");
</script>

@section('content')
<div class="row d-flex justify-content-center container">
    <div class="col-md-8">
      <div class="card-hover-shadow-2x mb-3 card">
        <div class="card-header-tab card-header">
          <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
              class="fa fa-tasks"></i>&nbsp;Toutes les taches <div class="badge badge-pill badge-info ml-2">{{count($tasks)}}</div> &nbsp;&nbsp;&nbsp;Completes: <div class="badge badge-pill badge-info ml-2">{{ $tasksComplet }}</div>&nbsp;&nbsp;&nbsp;En cours: <div class="badge badge-pill badge-info ml-2">{{ $tasksC }}</div></div>
          
        </div>
        <div class="scroll-area-sm">
          <perfect-scrollbar class="ps-show-limits">
            <div style="position: static;" class="ps ps--active-y">
              <div class="ps-content">
                <ul class=" list-group list-group-flush">
                  @foreach ($tasks as $item)
                  <li class="list-group-item">
                    <form action="{{route('completed.task',$item->id)}}" method="GET">
                        <div class="todo-indicator bg-warning"></div>
                        <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-2">
                            <div class="custom-checkbox custom-control">
                                <input name="complete" value="complete" class="custom-control-input"
                                id="exampleCustomCheckbox{{$item->id}}" type="checkbox" {{ $item->completed != 0 ? 'checked':'' }} >
                                <label class="custom-control-label"
                                for="exampleCustomCheckbox{{$item->id}}">&nbsp;
                                </label>
                                </div>
                            </div>
                            <div class="widget-content-left">
                            <div class="widget-heading">{{ $item->name }} <div class="badge badge-danger ml-2">Heure fin: {!! htmlspecialchars_decode( $item->end_task->format('h:i') ) !!}</div>
                            </div>
                            <div class="widget-subheading"><i>{{ $item->description }}</i> </div>
                            </div>
                        <div class="widget-content-right">
                            <button type="submit" class="border-0 btn-transition btn btn-outline-success">
                            <i class="fa fa-check"></i></button>
                            {{-- <button class="border-0 btn-transition btn btn-outline-danger">
                            <i class="fa fa-trash"></i> --}}
                            
                            </button>
                        </div>
                        </div>
                        </div>
                    </form>
                  </li>
                  @endforeach
                </ul>
              </div>
              
            </div>
          </perfect-scrollbar>
        </div>
        <div class="d-block text-right card-footer">
            <a href="{{route('closeDay')}}"  class="mr-2 btn btn-danger">Close Day</a>
            <button type="button" data-toggle="modal"  data-target="#CreationDeLaTache" class="btn btn-primary">Add Task</button></div>
      </div>
    </div>
    </div>
  
  <!-- introduction d'un modal -->
  <div class="modal fade" id="CreationDeLaTache" tabindex="-1" role="dialog" aria-labelledby="CreationDeLaTacheTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form methode="GET" action="{{route('add.taskM')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreationDeLaTacheTitle">Ajouter une tache dans la liste</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Montant</label>
                        <input type="text" name="name" class="form-control" placeholder="Entrez un montant"><br>
                        <input type="text" name="description" class="form-control" placeholder="Entrez un montant"><br>
                        <input type="time" name="endTaskDate" class="form-control" placeholder="Entrez un montant">
                    </div>
                        
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</a>
                    <button class="btn btn-primary" type="submit">Ajouter</button></div>
            </div>
        </form>
    </div>
</div>
<!-- introduction d'un modal -->

    
@endsection
