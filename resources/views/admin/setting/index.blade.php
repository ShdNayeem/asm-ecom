@extends('layouts.admin')
@section('title', 'Company Profile')
@section('content')
    
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="alert alert-success w-75">{{session('message')}}</div>
        @endif
        
        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <a href="{{url('admin/products')}}" class="text-decoration-none text-dark"><h2 class="fw-semibold text-secondary">Company Profile</h2></a>
                <a href="{{ url('admin/settings/edit') }}" class="btn btn-info">Edit</a>
            </div>

            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th class="fw-bold">Website Name</th>
                                    <th class="fw-bold">Website URL </th>
                                    <th class="fw-bold"> Page Title</th>
                                    <th class="fw-bold">Address</th>
                                    <th class="fw-bold">Phone 1</th>
                                    <th class="fw-bold">Phone 2</th>
                                    <th class="fw-bold">Email 1</th>
                                    <th class="fw-bold">Email 2</th>
                                    <th class="fw-bold">Instagram</th>
                                    <td class="fw-bold">Facebook</td>
                                    <td class="fw-bold">X (Twitter)</td>
                                    <td class="fw-bold">Youtube</td>
                                  
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($appSettings as $appSetting)
                                    <tr>
                                        
                                        <td>{{$appSetting->website_name}}</td>
                                        <td>{{$appSetting->website_url}}</td>
                                        <td>{{$appSetting->page_title}}</td>
                                        <td>{{$appSetting->address}}</td>
                                        <td>{{$appSetting->phone1}}</td>
                                        <td>{{$appSetting->phone2}}</td>
                                        <td>{{$appSetting->email1}}</td>
                                        <td>{{$appSetting->email1}}</td>
                                        <td>{{$appSetting->instagram}}</td>
                                        <td>{{$appSetting->facebook}}</td>
                                        <td>{{$appSetting->twitter}}</td>
                                        <td>{{$appSetting->youtube}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No Settings Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                </table>
                </div>
                
                        
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->

<!-- <div  wire:ignore.self class="modal fade" id="deleteSetting" tabindex="-1" aria-labelledby="deleteSetting" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center mt-1">
        <h1 class="modal-title fs-5 text-danger" id="deleteSetting" wire:click="closeModal"><i class="mdi mdi-alert-octagon"></i> Alert !</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url ('admin/settings/'.$appSetting->id.'/delete')}}" method="get">
            <div class="modal-body">
                <h5> Are you sure, you want to Delete?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                <button type="submit" class="btn btn-primary"> Delete </button>
            </div>
      </form>
      
    </div>
  </div>
</div> -->





@endsection