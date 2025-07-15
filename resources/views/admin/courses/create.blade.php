    @extends('layouts.user_type.auth')

    @section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Create New Course</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    {{-- Validation errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-text">{{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        {{-- Title --}}
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-control-label">Course Title</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="Enter course title" value="{{ old('title') }}">
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-control-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="0">FREE</option>
                                <option value="1">PAID</option>
                            </select>
                            @if ($errors->has('status'))
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                        {{-- Track --}}
                        <div class="col-md-6 mb-3">
                            <label for="track_id" class="form-control-label">Track</label>
                            <select name="track_id" id="track_id" class="form-control" required>
                                <option value="" disabled selected>Choose a track</option>
                                @foreach($tracks as $track)
                                    <option value="{{ $track->id }}" {{ old('track_id') == $track->id ? 'selected' : '' }}>
                                        {{ $track->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('track_id'))
                                <small class="text-danger">{{ $errors->first('track_id') }}</small>
                            @endif
                        </div>

                        {{-- Link --}}
                        <div class="col-md-6 mb-3">
                            <label for="link" class="form-control-label">Course Link</label>
                            <input class="form-control" type="text" id="link" name="link" placeholder="Enter course link" value="{{ old('link') }}">
                            @if ($errors->has('link'))
                                <small class="text-danger">{{ $errors->first('link') }}</small>
                            @endif
                        </div>

                        {{-- Images --}}
                        <div class="col-md-12 mb-3">
                            <label for="images" class="form-control-label">Course Images</label>
                            <input class="form-control" type="file" id="images" name="images[]" multiple>
                            <small class="text-muted">يمكنك رفع عدة صور، أول صورة ستكون الصورة الرئيسية</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-dark">Create Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
