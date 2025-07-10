@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Document Details</h4>
                    <a href="{{ route('documents.index') }}" class="btn btn-secondary">Back to Documents</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Document Information</h5>
                            <table class="table">
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $document->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $document->description ?? 'No description' }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $document->date->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Uploaded:</th>
                                    <td>{{ $document->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Actions</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">Download File</a>
                                <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning">Edit Document</a>
                                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this document?')">
                                        Delete Document
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 