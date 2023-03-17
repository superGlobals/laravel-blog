<div>
    {{-- Stop trying to control. --}}
    <form method="POST" wire:submit.prevent="changePassword()">
        <div class="row">
          <div class="col-md-4">
            <div class="mb-3">
              <label for="" class="form-label">Current Password</label>
              <input type="text" class="form-control" placeholder="Current Password" wire:model="current_password">
              @error('current_password')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label for="" class="form-label">New Password</label>
              <input type="text" class="form-control" placeholder="New Password" wire:model="new_password">
              @error('new_password')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label for="" class="form-label">Confirm new Password</label>
              <input type="text" class="form-control" placeholder="Retype new Password" wire:model="confirm_new_password">
              @error('confirm_new_password')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
      </form>
</div>
