@extends('layouts.user_type.auth')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-xs text-uppercase">Manage Tracks</h6>
            </div>
    @include('inclode.errors')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
  <div class="card-body">
                <form method="POST" action="{{ route('tracks.store') }}" autocomplete="off">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Track Name</label>
                            <input   type="text" name="name" class="form-control" placeholder="Track Name..." >
                        </div>

                        <div class="col-md-4 mt-3 mt-md-0">
                            <button type="submit" class="btn bg-gradient-primary btn-sm mb-1">
                                <i class="fas fa-save me-1"></i> Add Track
                            </button>

                        </div>
                    </div>
                </form>
            </div>
            @if(count($tracks))
            <div class="card-body pt-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO Courses</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tracks as $track)
                            <tr>
                                {{-- <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td> --}}
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $track->name }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ count($track->courses)}}</p>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{ $track->created_at ? $track->created_at->diffForHumans() : '--' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{-- Optional future buttons (edit, delete) --}}

                                    <a href="{{ route('tracks.edit', $track->id) }}" class="btn btn-link text-secondary text-xs px-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('tracks.destroy', $track->id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger text-xs px-2" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="text-center py-4">
                <p class="text-muted text-xs mb-0">No Tracks Found</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
