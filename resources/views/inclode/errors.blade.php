@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3 text-xs py-2 px-3" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

