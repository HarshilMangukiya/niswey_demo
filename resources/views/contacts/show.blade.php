@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-user me-2"></i>Contact Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>First Name:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->first_name }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Last Name:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->last_name }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-9">
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Phone:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->phone ?: 'Not provided' }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->created_at->format('F d, Y \a\t g:i A') }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Last Updated:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->updated_at->format('F d, Y \a\t g:i A') }}
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Contacts
                    </a>
                    <div>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
