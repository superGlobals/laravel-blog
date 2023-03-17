<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="page-header d-print-none mb-3">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
                Authors
              </h2>
              {{-- <div class="text-muted mt-1">1-18 of 413 people</div> --}}
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="d-flex">
                <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_author_modal">New user
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row row-cards">
        @forelse ($authors as $author)
        <div class="col-md-6 col-lg-3">
            <div class="card">
              <div class="card-body p-4 text-center">
                <span class="avatar avatar-xl mb-3 rounded-circle" style="background-image: url({{ $author->picture }})"></span>
                <h3 class="m-0 mb-1"><a href="#">{{ $author->name }}</a></h3>
                <div class="text-muted">{{ $author->email }}</div>
                <div class="mt-3">
                  <span class="badge bg-purple-lt">{{ $author->authorType->name }}</span>
                </div>
              </div>
              <div class="d-flex">
                <a href="#" class="card-btn">Edit</a>
                <a href="#" class="card-btn">Delete</a>
              </div>
            </div>
          </div>
        @empty
            <span class="text-danger">No Author Found</span>
        @endforelse
      </div>


{{-- MODALS --}}
<div wire:ignore.self class="modal modal-blur fade" id="add_author_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Add Author</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="addAuthor()" method="POST">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter author name" wire:model="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Enter author email" wire:model="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter author username" wire:model="username">
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Author Type</label>
                <select wire:mode="author_type" id="" class="form-select">
                    <option value=""></option>
                    @foreach (\App\Models\Type::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('author_type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <div class="form-label">Is direct publisher</div>
                <div>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="direct_publisher" value="0" wire:model="direct_publisher">
                    <span class="form-check-label">No</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model="direct_publisher">
                    <span class="form-check-label">Yes</span>
                  </label>
                  @error('direct_publisher')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>

</div>
