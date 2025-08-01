

<div class="row">
            <div class="col-md-12 grid-margin">
                @if (session('message'))
                    <p class="alert alert-success"> {{session('message')}}</p>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="fw-semibold text-secondary">Category</h2>
                        <a href="{{url('admin/category/create')}}" class="btn" style="background-color: green; color:white;"> Add Category</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="fw-bold">ID</th>
                                    <th class="fw-bold">Name</th>
                                    <th class="fw-bold">Slug</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Thumbnail</th>
                                    <th class="fw-bold">Actions</th>
                                    <!--
                                    <th>Image</th>
                                    <th>Meta Title</th>
                                    <th>Meta Keyword</th>
                                    <th>Meta Description</th> -->
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>{{$category->description}}</td>
                                        <td><img src="{{ asset('/uploades/category/'.$category->image) }}" alt="category image" style="height: 50px; width: 50px; object-fit: contain; border-radius: 0;"></td>
                                        <td>
                                            <a href="{{ url ('admin/category/'.$category->id.'/edit')}}" class="btn btn-info">Edit</a>
                                            <a href="#" wire:click="deleteCategory({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</a>  
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        
                        {{$categories->links()}}
                    </div>
                </div>

                    <!-- Delete Button Model  -->
                     
                <div wire:ignore.self class="modal fade" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="mdi mdi-alert-octagon"></i> Alert !</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
                        </div>

                        <form wire:submit.prevent="destroyCategory">
                            <div class="modal-body">
                                <h5>Are you sure, you want to Delete?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </form>
                        
                        </div>
                    </div>
                    </div>
            </div>
    </div>

@push('script')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#deleteModal').modal('hide');
        });
    </script>

    <script>
        $('#myTable').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100]
        });
    </script>
@endpush