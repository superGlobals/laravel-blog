@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'All Posts')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            All Posts
          </h2>
        </div>
      </div>
    </div>
  </div>

  @livewire('all-posts')
@endsection

@push('scripts')
    <script>
      // show delete 
      window.addEventListener('deletePost', function(event) {
            swal.fire({
                title: event.detail.title,
                icon: 'warning',
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                // width: 300,
                allowOutsideClick: false,
            }).then(function(result) {
                if(result.value) {
                  window.livewire.emit('deletePostAction', event.detail.id);
                    // Livewire.emit('deleteAuthorAction', event.detail.id);
                }
            });
        });
    </script>
@endpush