@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <p class="col-md-4">
                                Notes Dashboard
                            </p>

                            <!-- Button trigger modal -->
                            <button type="button" class=" col-sm-2 col-sm-offset-6 btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                Create
                            </button>
                        </div>

                        <!-- Create Note Modal -->
                        {!! Form::open(['url' => 'notes']) !!}
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Create Notes</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                {!! Form::label('title', 'Note Title') !!}
                                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('content', 'Note Content') !!}
                                                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="panel-body">
                        @if(sizeof($notes)==0)
                            <p>
                               No notes created by {{Auth::user()->name}}
                            </p>
                        @else
                           <table class="table">
                               <thead>
                               <th>
                                   Title
                               </th>
                               <th>
                                   Created On
                               </th>
                               <th>
                                   Updated On
                               </th>
                               <th>
                                   Edit
                               </th>
                               <th>
                                   Delete
                               </th>
                               </thead>
                               <tbody>
                                @foreach($notes as $str)
                                   <tr>
                                       <td>
                                           {{$str->title}}
                                       </td>
                                       <td>
                                           {{$str->created_at}}
                                       </td>
                                       <td>
                                           {{$str->updated_at}}
                                       </td>
                                       <td>
                                           <a data-toggle="modal" role="button"
                                              href="{{ URL::to('notes/show/'.$str->id) }}" class="btn btn-warning">Edit</a>
                                       </td>
                                       <td>
                                           {{ Form::open([ 'route' => ['notes.destroy',$str->id],'method' => 'DELETE']) }}
                                           {{ Form::hidden('id', $str->id) }}
                                           {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                           {{ Form::close() }}
                                       </td>
                                   </tr>
                                @endforeach
                               </tbody>
                           </table>
                        @endif
                    </div>
                @if(!empty($note))
                    <!-- Form modal -->
                        <div id="edit_modal" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Edit Note</h4>
                                    </div>

                                    <!-- Form inside modal -->
                                    {!! Form::model($note,array('route' => ['notes.update', $note->id],'method'=>'POST')) !!}

                                    <div class="modal-body with-padding">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            {!! Form::label('title', 'Note Title') !!}
                                                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            {!! Form::label('content', 'Note Content') !!}
                                                            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                        @endif

                                        @if(!empty($note))
                                            <script>
                                                $(function() {
                                                    $('#edit_modal').modal('show');
                                                });
                                            </script>
                                        @endif

                                    </div>
            </div>
        </div>
    </div>


@endsection
