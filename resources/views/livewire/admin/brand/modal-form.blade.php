<!-- Add Brand - Modal -->

<div  wire:ignore.self class="modal fade" id="addBrand" tabindex="-1" aria-labelledby="addBrand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="addBrand" wire:click="closeModal">Add Brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="storeBrand">
            <div class="modal-body">
                <div>
                    <label for="" class="mb-2"> Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-body">
                <div>
                    <label for="" class="mb-2"> Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Enter Slug">
                    @error('slug')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-body">
                <div>
                    <label for="" class="mb-2"> Brand Description</label>
                    <textarea name="" id="" wire:model.defer="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter Description"></textarea>
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                <button type="submit" class="btn btn-primary"> Save </button>
            </div>
      </form>
      
    </div>
  </div>
</div>


<!-- Update Brand - Modal -->

<div  wire:ignore.self class="modal fade" id="updateBrand" tabindex="-1" aria-labelledby="updateBrand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="updateBrand">Update Brand</h1>
        <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div>
            <form wire:submit.prevent="updateBrand">
            <div class="modal-body">
                <div>
                    <label for="" class="mb-2"> Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
           
                <div>
                    <label for="" class="mb-2"> Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Enter Slug">
                    @error('slug')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            
                <div>
                    <label for="" class="mb-2"> Brand Description</label>
                    <textarea name="" id="" wire:model.defer="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter Description"></textarea>
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                <button type="submit" class="btn btn-primary"> Update</button>
            </div>
      </form>
      </div>
      
      
    </div>
  </div>
</div>


<!-- Delete Brand - Modal -->

<div  wire:ignore.self class="modal fade" id="deleteBrand" tabindex="-1" aria-labelledby="deleteBrand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="deleteModal">Delete Brand</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div>
            <form wire:submit.prevent="destroyBrand">
                <div class="modal-body">
                    <h4> Are you sure, you want to Delete this Brand?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> Delete</button>
                </div>
            </form>
      </div>
      
      
    </div>
  </div>
</div>