@extends('layouts.user_type.auth')
<!-- هذا السطر لازم يكون في رأس الملف layout.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">All Users</h5>
                    </div>
                    <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Photo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                </td>
                                <td>
                                    <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3" alt="user-avatar">
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->role ?? 'User' }}</p>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d/m/Y') }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <!-- Edit Button -->
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-link text-secondary px-2 mb-0" title="Edit">
                                            <i class="fas fa-user-edit text-xs"></i>
                                        </a>
                                        <!-- Delete Form -->
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-2 mb-0" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($users->isEmpty())
                        <div class="text-center p-4">
                            <p class="text-muted mb-0">No users found.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
