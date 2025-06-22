@extends('layouts.admin')
@section('content')
    
<div class="row">
            <div class="col-md-12 grid-margin">
                @if (session('message'))
                    <p class="alert alert-success"> {{session('message')}}</p>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <a href="{{url('admin/sliders')}}" class="text-decoration-none text-dark"><h2>Sliders</h2></a>
                        <a href="{{url('admin/sliders/create')}}" class="btn btn-primary"> Add Slider</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <div class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Slider Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </div>

                            <div class="tbody">
                                @forelse ($sliders as $slider )
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$slider->title}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td>
                                        <img src="{{asset ($slider->image) }}" style="width: 100px; height: 70px; border-radius: 0" alt="Slider Image">
                                    </td>
                                    <td>
                                        <a href="{{url ('admin/sliders/'.$slider->id.'/edit')}}" class="btn btn-primary"> Edit</a>
                                        <a href="{{url ('admin/sliders/'.$slider->id.'/delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"> Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Slider Available</td>
                                    </tr>
                                @endforelse
                                
                            </div>
                        </table> 
        
                    </div>
                </div>


                    <!-- Delete Button Model  -->
                     
                <div class="modal fade" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-danger"><i class="mdi mdi-alert-octagon"></i> Alert !</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
                        </div>

                            <div class="modal-body">
                                <h5>Are you sure, you want to Delete?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form method="get" action="{{url ('admin/sliders/{slider}/destroy')}}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </div>
                        
                        </div>
                    </div>
                    </div>
            </div>
    </div>

@endsection