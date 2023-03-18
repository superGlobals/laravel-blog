<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills">
                    <h4>Categories</h4>
                    <li class="nav-item ms-auto">
                      <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categories_modal">Add Category</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                              <th>Category Name</th>
                              <th>No. of Subcategories</th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($categories as $category)
                              <tr>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->subcategories->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary btn-sm" wire:click.prevent="editCategory({{ $category->id }})">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </td>
                              </tr>
                            @empty
                                <tr>
                                  <td colspan="3"><span class="text-danger">No category found</span></td>
                                </tr>
                            @endforelse
                            
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills">
                    <h4>SubCategories</h4>
                    <li class="nav-item ms-auto">
                      <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#subcategories_modal">Add SubCategory</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                              <th>SubCategory Name</th>
                              <th>Parent Category</th>
                              <th>No. of Posts</th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($subcategories as $subcategory)
                              <tr>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->parentCategory->category_name }}</td>
                                <td>4</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary btn-sm" wire:click.prevent="editSubCategory({{ $subcategory->id }})">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                
                            @endforelse
                            
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    
      
    {{-- CATEGORIES MODAL --}}
    <div wire:ignore.self class="modal modal-blur fade" id="categories_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form method="POST" class="modal-content" 
            @if ($updateCategoryMode)
                wire:submit.prevent="updateCategory()"
            @else
                wire:submit.prevent="addCategory()"
            @endif
          >
            <div class="modal-header border-0">
              <h5 class="modal-title">{{ $updateCategoryMode ? 'Update Category' : 'Add Category' }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              @if ($updateCategoryMode)
                  <input type="hidden" wire:model="selected_category_id">
              @endif
                <div class="mb-3">
                    <label for="" class="form-label">Category name</label>
                    <input type="text" class="form-control" placeholder="Enter category name" wire:model="category_name">
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">{{ $updateCategoryMode ? 'Update' : 'Save' }}</button>
              </div>
          </form>
        </div>
      </div>
    
    
    
    
    
    
        
    {{-- SUBCATEGORIES MODAL --}}

    <div wire:ignore.self class="modal modal-blur fade" id="subcategories_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content" 
          @if ($updateSubCategoryMode)
              wire:submit.prevent="updateSubCategory()"
          @else
              wire:submit.prevent="addSubCategory()"
          @endif
        >
          <div class="modal-header border-0">
            <h5 class="modal-title">{{ $updateSubCategoryMode ? 'Update SubCategory' : 'Add SubCategory' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if ($updateSubCategoryMode)
              <input type="hidden" wire:model="selected_subcategory_id">
            @endif
              <div class="mb-3">
                <div class="form-label">Parent Category</div>
                <select class="form-select" wire:model="parent_category">
                  @if (!$updateSubCategoryMode)
                      <option value="">No Selected</option>
                  @endif
                  @foreach (\App\Models\Category::all() as $category)
                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
                </select>
                @error('parent_category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="" class="form-label">SubCategory name</label>
                  <input type="text" class="form-control" placeholder="Enter subcategory name" wire:model="subcategory_name">
                  @error('subcategory_name')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateSubCategoryMode ? 'Update' : 'Save' }}</button>
            </div>
        </form>
      </div>
    </div>

</div>
