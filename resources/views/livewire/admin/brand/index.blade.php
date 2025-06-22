<div>

    @include('livewire.admin.brand.modal-form')
    
         <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="ms-2"> Brands</h2>
                       <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrand"> Add Brand </a> 
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> <strong> ID </strong> </th>
                                    <th> <strong> Name </strong></th>
                                    <th> <strong> Slug </strong></th>
                                    <th> <strong> Description </strong></th>
                                    <th> <strong> Actions </strong></th>
                                </tr>
                            </thead>

                             <tbody>
                              @forelse ($brands as $brand)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td>{{$brand->name}}</td>
                                    <td>{{$brand->slug}} </td>
                                    <td>{{$brand->description}} </td>
                                    <td>
                                        <a href="#" wire:click="editBrand({{ $brand->id }})"  data-bs-toggle="modal" data-bs-target="#updateBrand" class="btn btn-primary"> Edit </a>
                                        <a href="#" wire:click="deleteBrand({{ $brand->id }})"  data-bs-toggle="modal" data-bs-target="#deleteBrand" class="btn btn-danger"> Delete </a>
                                    </td>
                                </tr>
                            
                            @empty
                            <tr>
                                <td colspan="5">No Brands Found</td>
                            </tr>
                        @endforelse
                            </tbody>
                        </table>
                        {{$brands->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@push('script')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addBrand').modal('hide');
            $('#updateBrand').modal('hide');
            $('#deleteBrand').modal('hide');
        });
    </script>
@endpush