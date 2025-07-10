@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>My Documents</h4>
                    @if(Auth::user()->email === 'admin@docmag.com')
                        <a href="{{ route('documents.create') }}" class="btn btn-success">Upload New Document</a>
                    @endif
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

                    @if($documents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>{{ $document->title }}</td>
                                            <td>{{ Str::limit($document->description, 50) }}</td>
                                            <td>{{ $document->date->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-outline-primary">
                                                    Download
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-info">View</a>
                                                @if(Auth::user()->email === 'admin@docmag.com')
                                                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this document?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5>No documents found</h5>
                            <p>You haven't uploaded any documents yet.</p>
                            @if(Auth::user()->email === 'admin@docmag.com')
                                <a href="{{ route('documents.create') }}" class="btn btn-primary">Upload Your First Document</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 