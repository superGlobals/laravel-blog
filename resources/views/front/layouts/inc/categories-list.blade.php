@foreach (categories() as $item)
    <li><a href="{{ route('category-post', $item->slug) }}">{{ Str::ucfirst($item->subcategory_name) }}<span
                class="ml-auto">({{ $item->posts->count() }})</span></a></li>
@endforeach
