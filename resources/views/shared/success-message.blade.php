@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{-- Idea created Successfully --}}
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
