@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h4>Welcome to DOCmag - Document Management System</h4>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">📄 Document Management</h5>
                                    <p class="card-text">Manage your personal document library.</p>
                                    <a href="{{ route('documents.index') }}" class="btn btn-primary">View Documents</a>
                                    @if(Auth::user()->email === 'admin@docmag.com')
                                        <a href="{{ route('documents.create') }}" class="btn btn-success">Upload Document</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">👤 Profile</h5>
                                    <p class="card-text">Update your profile information.</p>
                                    <a href="{{ route('profile') }}" class="btn btn-info">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(in_array(auth()->user()->email, ['admin@docmag.com']))
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">👥 User Management</h5>
                                    <p class="card-text">Manage all users in the system.</p>
                                    <a href="{{ route('users.index') }}" class="btn btn-warning">Manage Users</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">📧 Email System</h5>
                                    <p class="card-text">Send recent documents to users.</p>
                                    <a href="{{ route('emails.index') }}" class="btn btn-secondary">Email Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
