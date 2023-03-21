<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
    @if(all_tags() != null)
    @php
        $allTagsString = all_tags();
        $allTagsArray = explode(',', $allTagsString);
        // sort($allTagsArray);
    @endphp
    <div class="col-lg-12 col-md-6">
        <div class="widget">
            <h2 class="section-title mb-3">Tags</h2>
            <div class="widget-body">
                <ul class="widget-list">
                    @foreach (array_unique($allTagsArray) as $tag)
                        <li><a href="{{ route('tag-post', $tag) }}">#{{ $tag }}</a></li>
                    @endforeach
                    {{-- @include('front.layouts.inc.categories-list') --}}
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>