<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row">
        <div class="col-md-5 mb-3">
            <label for="" class="form-label">Search</label>
            <input type="text" name="" id="" class="form-control" placeholder="Keyword..." wire:model="search">
        </div>
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Category</label>
            <select name="" id="" class="form-select" wire:model="category">
                <option value="">-- Sort by Category --</option>
                @foreach (\App\Models\SubCategory::whereHas('posts')->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                @endforeach
            </select>
        </div>
        @if(auth()->user()->type == 1)
        <div class="col-md-3 mb-3">
            <label for="" class="form-label">Author</label>
            <select name="" id="" class="form-select" wire:model="author">
                <option value="">-- Sort by Author --</option>
                @foreach (\App\Models\User::whereHas('posts')->get() as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">SortBy</label>
            <select name="" id="" class="form-select" wire:model="orderBy">
                <option value="">-- SortBy --</option>
                <option value="asc">ASCENDING</option>
                <option value="desc">DESCENDING</option>
            </select>
        </div>
    </div>

    <div class="row row-cards">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="/storage/images/post_images/thumbnails/resized_{{ $post->featured_image }}" class="card-img-top" alt="">
                    <div class="card-body p-2">
                        <h3 class="mb-0 mb-1">{{ $post->post_title }}</h3>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('author.posts.edit-post', ['post_id'=>$post->id]) }}" class="card-btn">Edit</a>
                        <a href="" wire:click.prevent="deletePost({{ $post->id }})" class="card-btn">Delete</a>
                    </div>
                </div>
            </div>
        @empty
            <span class="text-danger">No posts found</span>
        @endforelse
    </div>
    <div class="d-block mt-2">
        {{ $posts->links('livewire::bootstrap') }}
    </div>
</div>
