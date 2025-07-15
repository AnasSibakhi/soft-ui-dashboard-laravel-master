@extends('layouts.user_type.auth')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3 mx-3">
            <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-uppercase" style="font-size: 12px;">Manage Videos</h6>
                <a href="{{ route('videos.create') }}" class="btn btn-sm btn-primary" style="font-size: 11px;">
                    <i class="fas fa-plus me-1"></i> Add Videos
                </a>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body pt-0">
                @if($Videos && $Videos->count())
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Videos as $Video)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{ route('videos.show', $Video->id) }}" class="video-link">
                                                {{ \Str::limit($Video->title, 50) }}
                                                <i class="fas fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $Video->course->title ?? '--' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $Video->created_at ? $Video->created_at->diffForHumans() : '--' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('videos.edit', $Video->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('videos.destroy', $Video->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted text-xs mb-0">No Videos Found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
