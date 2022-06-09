
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="  {{asset('multiselect/jquery.dropdown.js')}}"></script>
<link rel="stylesheet" href="{{asset('multiselect/jquery.dropdown.css')}}">

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center container">
        <div class="col-md-8">
          <div class="card-hover-shadow-2x mb-3 card">
            <div class="card-header-tab card-header">
              <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                  class="fa fa-tasks"></i>&nbsp;
                  <select name="" id="day_id">
                    <option value="">Filter By Date</option>
                      @foreach ($dates as $item)
                      <option value="{{ $item }}">{{ $item }}</option>
                      @endforeach   
                  </select>
                   <div class="badge badge-pill badge-info ml-2">{{count($tasks)}}</div> &nbsp;</div>
              
            </div>
            <div class="scroll-area-sm">
              <perfect-scrollbar class="ps-show-limits">
                <div style="position: static;" class="ps ps--active-y">
                  <div class="ps-content">
                    <ul class=" list-group list-group-flush" id="list_by_day">
                      @foreach ($tasks as $item)
                      <li class="list-group-item" >
                            <div class="todo-indicator bg-warning"></div>
                            <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-2">
                                  <div class="custom-checkbox custom-control">
                                      <input name="complete" class="custom-control-input"
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
                            </div>
                            </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                  
                </div>
              </perfect-scrollbar>
            </div>
          </div>
        </div>
        </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#day_id').on('change', function () {
            var day = this.value;
            $('#list_by_day').html('');
            $.ajax({
                url: '{{ route('task_by_day') }}?day='+day,
                type: 'get',
                success: function (res) {
                    $('#list_by_day').html('<p>Select all Task</p>');
                    $.each(res, function (key, value) {
                        // $('#list_by_day').append('<option value="' + value
                        //     .id + '">' + value.name + '</option>');
                        var isComplet = value.completed != 0 ? 'checked' : '';
                        let heure = value.end_task;
                        var now = new Date(heure);
                        var hour    = now.getHours();
                        var minute  = now.getMinutes();
                        $('#list_by_day').append(`
                          <li class="list-group-item" >
                                <div class="todo-indicator bg-warning"></div>
                                <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-2">
                                    <div class="custom-checkbox custom-control">
                                        <input name="complete" class="custom-control-input"
                                        id="exampleCustomCheckbox`+value.id+`" type="checkbox"` + isComplet + `>
                                        <label class="custom-control-label"
                                        for="exampleCustomCheckbox`+value.id+`">&nbsp;
                                        </label>
                                      </div>
                                  </div>
                                    <div class="widget-content-left mr-2">
                                    <div class="widget-content-left">
                                    <div class="widget-heading">`+ value.name +` <div class="badge badge-danger ml-2">Heure fin: `+  hour+`:`+minute  +` </div>
                                    </div>
                                    <div class="widget-subheading"><i>`+ value.description +` </i> </div>
                                    </div>
                                </div>
                                </div>
                          </li>
                        `);
                    });
                }
            });
        });

  });
</script>
@endsection
