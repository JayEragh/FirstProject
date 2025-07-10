@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>User Details</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>User Information</h5>
                            <table class="table">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Company:</th>
                                    <td>{{ $user->company ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Joined:</th>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Actions</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this user?')">
                                        Delete User
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5>User Documents ({{ $user->documents->count() }})</h5>
                    @if($user->documents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Uploaded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->documents as $document)
                                        <tr>
                                            <td>{{ $document->title }}</td>
                                            <td>{{ Str::limit($document->description, 50) }}</td>
                                            <td>{{ $document->date->format('M d, Y') }}</td>
                                            <td>{{ $document->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">This user hasn't uploaded any documents yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 