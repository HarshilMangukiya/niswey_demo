@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-2 mb-4">
    <h1 class="mb-0"><i class="fas fa-address-book me-2"></i>Contacts</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Add Contact
        </a>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importXmlModal">
            <i class="fas fa-upload me-1"></i>Import XML
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="contactsTable" class="table table-striped table-hover align-middle w-100">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection



<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this contact? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    </div>

<!-- Import XML Modal -->
<div class="modal fade" id="importXmlModal" tabindex="-1" aria-labelledby="importXmlModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importXmlModalLabel"><i class="fas fa-upload me-2"></i>Import Contacts from XML</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('contacts.import.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="xml_file_modal" class="form-label">Select XML File *</label>
                        <input type="file" class="form-control" id="xml_file_modal" name="xml_file" accept=".xml" required>
                        <div class="form-text">Maximum file size: 2MB</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize DataTable (server-side)
        const tableElement = document.getElementById('contactsTable');
        if (tableElement && typeof $(tableElement).DataTable === 'function') {
            $(tableElement).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('contacts.data') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'created', name: 'created' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[3, 'desc']],
                pageLength: 10,
                lengthChange: false,
                language: { search: "Search:" }
            });
        }

        // Delete confirmation modal handler
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        if (deleteConfirmModal) {
            deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const deleteUrl = button && button.getAttribute('data-delete-url');
                const form = deleteConfirmModal.querySelector('form');
                if (form && deleteUrl) {
                    form.setAttribute('action', deleteUrl);
                }
            });
        }
    });
</script>
@endpush
