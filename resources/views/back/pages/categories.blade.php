@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')

@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Categories & Subcategories
          </h2>
        </div>
      </div>
    </div>
  </div>

@livewire('categories')
  
@endsection

@push('scripts')
    <script>
      
      // $(window).on('hidden.bs.modal', function() {
      //       Livewire.emit('resetForms');
      //   });

        // hide add category modal
        window.addEventListener('hideCategoriesModal', function(event) {
            $('#categories_modal').modal('hide');
        });

        // show edit category modal
        window.addEventListener('showCategoriesModal', function(event) {
            $('#categories_modal').modal('show');
        });

        // hide subcategory modal
        window.addEventListener('hideSubCategoriesModal', function(event) {
            $('#subcategories_modal').modal('hide');
        });

         // show subcategory modal
         window.addEventListener('showSubCategoriesModal', function(event) {
            $('#subcategories_modal').modal('show');
        });

        $('#categories_modal, #subcategories_modal').on('hidden.bs.modal',function(e) {
          Livewire.emit('resetModalForm');
        });
    </script>
@endpush