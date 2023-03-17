<div>
    {{-- In work, do what you enjoy. --}}

    <form method="POST" wire:submit.prevent="UpdateDetails()">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Name" wire:model="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" wire:model="username">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" placeholder="Email" disabled>
                  </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Biography</label>
            <textarea class="form-control" rows="6" placeholder="Content.." wire:model="biography">Oh! Come and see the violence inherent in the system! Help, help, I'm being repressed! We shall say 'Ni' again to you, if you do not appease us. I'm not a witch. I'm not a witch. Camelot!</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
    
</div>
