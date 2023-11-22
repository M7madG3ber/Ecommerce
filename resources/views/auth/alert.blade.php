@if (session()->has('alert'))
<div class="form-outline mb-4">
      <div class="alert alert-primary fade show d-flex justify-content-between align-items-center" role="alert">
            <span>{{ session('alert') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
</div>
@endif