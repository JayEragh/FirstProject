@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Email Dashboard</h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Send Recent Documents to All Users</h5>
                                </div>
                                <div class="card-body">
                                    <p>Send the most recent documents (last 7 days) to all registered users.</p>
                                    <form action="{{ route('emails.send') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Send to All Users</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Total Users:</strong> {{ $users }}</p>
                                    <p><strong>Recent Documents:</strong> {{ $recentDocuments->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($recentDocuments->count() > 0)
                        <div class="mt-4">
                            <h5>Recent Documents (Last 7 Days)</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>User</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentDocuments as $document)
                                            <tr>
                                                <td>{{ $document->title }}</td>
                                                <td>{{ $document->user->firstname }} {{ $document->user->lastname }}</td>
                                                <td>{{ $document->created_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 text-center">
                            <p>No recent documents found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 