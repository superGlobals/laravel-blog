<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <form method="POST" wire:submit.prevent="updateBlogSocialMedia()">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="" class="form-label">Facebook</label>
              <input type="text" class="form-control" placeholder="Facebook page Url" wire:model="facebook_url">
              @error('facebook_url')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="" class="form-label">Instagram</label>
              <input type="text" class="form-control" placeholder="Instagram page Url" wire:model="instagram_url">
              @error('instagram_url')
                <span class="text-danger">{{ $message }}</span>
              @enderror 
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="" class="form-label">Youtube</label>
              <input type="text" class="form-control" placeholder="Youtube channel Url" wire:mode="youtube_url">
              @error('youtube_url')
                <span class="text-danger">{{ $message }}</span>
              @enderror 
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="" class="form-label">LinkedIn</label>
              <input type="text" class="form-control" placeholder="LinkedIn Url" wire:model="linkedin_url">
              @error('linkedin_url')
                <span class="text-danger">{{ $message }}</span>
              @enderror 
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
</div>
