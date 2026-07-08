@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/custome_backend/main.css') }}" />
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<style>
    :root {
        --primary-blue: #2563eb;
        --primary-blue-light: #3b82f6;
        --primary-blue-dark: #ffffff;
        --accent-blue: #60a5fa;
        --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --bg-light: #f8fafc;
        --bg-white: #ffffff;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --radius-sm: 0.5rem;
        --radius-md: 0.75rem;
        --radius-lg: 1rem;
        --radius-xl: 1.5rem;
    }

    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .page-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .page-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .page-box {
        background: #1e3556;
        backdrop-filter: blur(10px);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-blue-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .breadcrumb-item {
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .breadcrumb-item a {
        color: white;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-blue-dark);
    }

    .breadcrumb-item.active {
        color: var(--text-dark);
        font-weight: 500;
    }

    /* Stats Cards */
    .stats-header {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stats-item {
        background: #1e3556;
        padding: 2rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        text-align: center;
        position: relative;
        overflow: hidden;
        transform: translateY(0);
    }

    .stats-item::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .stats-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .stats-number {
        display: block;
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        line-height: 1;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .stats-label {
        display: block;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        position: relative;
        z-index: 1;
    }

    /* Card Styles */
    .card {
        background: var(--bg-white);
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .card:hover {
        box-shadow: var(--shadow-xl);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-dark) 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: var(--radius-xl) var(--radius-xl) 0 0;
    }

    .card-header h5 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        color: white;
        gap: 0.75rem;
    }

    .card-header .btn-group {
        display: flex;
        gap: 0.75rem;
    }

    /* Button Styles */
    .btn {
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: var(--radius-sm);
        border: 2px solid transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-light {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-color: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }

    .btn-light:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-outline-light {
        background: transparent;
        color: white;
        border-color: rgba(255, 255, 255, 0.5);
    }

    .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: white;
        color: white;
        transform: translateY(-2px);
    }

    /* Table Styles */
    .card-body {
        padding: 0;
    }

    .table-responsive {
        border-radius: 0 0 var(--radius-xl) var(--radius-xl);
        overflow: hidden;
    }

    .table {
        margin: 0;
        font-size: 0.875rem;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: #1e3556;
        color: var(--primary-blue-dark);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1.25rem 1.5rem;
        border: none;
        border-bottom: 2px solid var(--primary-blue);
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
        font-size: 0.75rem;
    }

    .table tbody tr {
        border-bottom: 1px solid var(--border-color);
        background: white;
    }

    .table tbody tr:hover {
        background: linear-gradient(to right, #eff6ff, #dbeafe);
        transform: scale(1.001);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
    }

    .table tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        color: var(--text-dark);
        border: none;
    }

    .table tbody td:first-child {
        font-weight: 700;
        color: var(--primary-blue);
        width: 5%;
        text-align: center;
        font-size: 1rem;
    }

    .icon-sm {
        width: 1.125rem;
        height: 1.125rem;
        opacity: 0.7;
    }

    .company-name {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--text-dark);
        gap: 0.5rem;
        cursor: pointer;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .company-name:hover {
        color: var(--primary-blue-light);
    }

    .company-name i {
        color: var(--primary-blue);
        font-size: 1.25rem;
    }

    .contact-email {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0;
    }

    .contact-email:hover {
        color: var(--primary-blue-light);
        text-decoration: underline;
    }

    .business-type {
        background: #1e3556;
        color: var(--primary-blue-dark);
        padding: 0.375rem 1rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: var(--shadow-sm);
    }

    .contact-date {
        font-size: 0.875rem;
        color: var(--text-dark);
        white-space: nowrap;
        font-weight: 500;
    }

    .contact-date small {
        display: block;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    /* DataTables Styling */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        padding: 1.5rem;
        background: white;
        border-bottom: 1px solid var(--border-color);
    }

    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 1.5rem;
        background: white;
        border-top: 1px solid var(--border-color);
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid var(--border-color);
        border-radius: var(--radius-sm);
        padding: 0.625rem 1rem;
        margin-left: 0.75rem;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .dataTables_wrapper .dataTables_length select {
        border: 2px solid var(--border-color);
        border-radius: var(--radius-sm);
        padding: 0.5rem 2rem 0.5rem 0.75rem;
        margin: 0 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: var(--radius-sm);
        padding: 0.5rem 0.75rem;
        margin: 0 0.25rem;
        border: 2px solid var(--border-color);
        background: white;
        color: var(--primary-blue);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        background: var(--bg-white);
    }

    .modal-header {
        background: #1e3556;
        color: white;
        border: none;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }

    .modal-title {
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
        color:white;
    }

    .modal-body {
        padding: 2rem;
        background: var(--bg-white);
    }

    .modal-body h6 {
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.5rem;
    }

    .modal-body p {
        margin-bottom: 1rem;
        color: var(--text-dark);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body strong {
        color: var(--text-dark);
        min-width: 120px;
        font-weight: 600;
    }

    .modal-body a {
        color: var(--primary-blue);
    }

    .modal-body a:hover {
        color: var(--primary-blue-light);
        text-decoration: underline;
    }

    .modal-body .border {
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
    }

    .modal-footer {
        border: none;
        padding: 1rem 2rem;
        background: var(--bg-white);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-content {
            padding: 0 1rem;
        }

        .page-box {
            padding: 1.5rem;
            border-radius: var(--radius-lg);
        }

        .stats-header {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stats-item {
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2rem;
        }

        .card-header {
            flex-direction: column;
            gap: 1rem;
            padding: 1.25rem;
        }

        .card-header h5 {
            font-size: 1.25rem;
        }

        .table {
            font-size: 0.75rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .modal-dialog {
            margin: 0.5rem;
        }

        .modal-body {
            padding: 1rem;
        }

        .modal-body p {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
        }
    }

    /* Loading Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-box,
    .stats-item,
    .card {
        animation: fadeIn 0.5s ease-out;
    }

    .stats-item:nth-child(2) {
        animation-delay: 0.1s;
    }

    .stats-item:nth-child(3) {
        animation-delay: 0.2s;
    }

    .card {
        animation-delay: 0.3s;
    }
</style>
@endsection

@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Header Section -->
        <div class="page-box banner-manager-container">
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <h3 class="page-title">
                            <i class="fas fa-building"></i>
                            Supplier Registrations
                        </h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('testCurricular.index') }}">
                                    <i class="fas fa-home me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Supplier Registrations</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
            
        <!-- Stats Header -->
        <div class="stats-header">
            <div class="stats-item">
                <span class="stats-number">{{ $SupplierRegistration->count() }}</span>
                <span class="stats-label">Total Registrations</span>
            </div>
            <div class="stats-item">
                <span class="stats-number">{{ $SupplierRegistration->where('created_at', '>=', now()->subDays(7))->count() }}</span>
                <span class="stats-label">This Week</span>
            </div>
            <div class="stats-item">
                <span class="stats-number">{{ $SupplierRegistration->where('created_at', '>=', now()->subDays(30))->count() }}</span>
                <span class="stats-label">This Month</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="background: #1e3556;">
                <h5>
                    <i class="fas fa-list-ul"></i>
                    All Registrations
                </h5>
                <div class="btn-group">
                    <a href="#" class="btn btn-outline-light" onclick="refreshTable()" style="background: #1e3556;">
                        <i class="fas fa-sync-alt"></i>Refresh
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="supplierTable" class="table mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag icon-sm"></i> #</th>
                                <th><i class="fas fa-building icon-sm"></i> Company</th>
                                <th><i class="fas fa-user icon-sm"></i> Contact</th>
                                <th><i class="fas fa-envelope icon-sm"></i> Email</th>
                                <th><i class="fas fa-briefcase icon-sm"></i> Business Type</th>
                                <th><i class="fas fa-calendar-alt icon-sm"></i> Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($SupplierRegistration as $index => $supplier)
                                <tr data-supplier="{{ $supplier->toJson() }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="company-name view-details">
                                        <i class="fas fa-building"></i>
                                        {{ $supplier->company_name }}
                                    </td>
                                    <td>
                                        {{ $supplier->contact_name ?? '—' }}
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $supplier->contact_email }}" class="contact-email">
                                            {{ $supplier->contact_email }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($supplier->business_type)
                                            <span class="business-type">{{ $supplier->business_type }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="contact-date">
                                        {{ $supplier->created_at->format('d M Y') }}
                                        <small>{{ $supplier->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Supplier Details Modal -->
        <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierModalLabel">
                            <i class="fas fa-building"></i>
                            Supplier Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Company Information</h6>
                                <p><strong>Name:</strong> <span id="modal-company_name"></span></p>
                                <p><strong>Website:</strong> <a id="modal-company_website" href="#" target="_blank" class="text-primary"></a></p>
                                <p><strong>Address:</strong> <span id="modal-company_address"></span></p>
                                <p><strong>Year Established:</strong> <span id="modal-year_established"></span></p>
                                <p><strong>Business Type:</strong> <span id="modal-business_type"></span></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Primary Contact</h6>
                                <p><strong>Name:</strong> <span id="modal-contact_name"></span></p>
                                <p><strong>Job Title:</strong> <span id="modal-job_title"></span></p>
                                <p><strong>Email:</strong> <a id="modal-contact_email" href="#" class="text-primary"></a></p>
                                <p><strong>Phone:</strong> <a id="modal-contact_phone" href="#" class="text-primary"></a></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Products / Services</h6>
                                <p><strong>Category:</strong> <span id="modal-product_category"></span></p>
                                <p><strong>Description:</strong></p>
                                <div id="modal-product_description" class="border rounded p-2 bg-light" style="white-space: pre-wrap; max-height: 150px; overflow-y: auto;"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Documentation</h6>
                                <p><strong>Brochure:</strong> <span id="modal-brochure"></span></p>
                                <p><strong>Certifications:</strong> <span id="modal-certifications"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<script>
$(document).ready(function () {
    $('#supplierTable').DataTable({
        "pageLength": 15,
        "order": [[5, "desc"]],
        "language": {
            "search": "<i class='fas fa-search me-2'></i>Search:",
            "lengthMenu": "_MENU_ entries per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ registrations",
            "paginate": {
                "previous": "<i class='fas fa-chevron-left'></i> Previous",
                "next": "Next <i class='fas fa-chevron-right'></i>",
                "first": "<i class='fas fa-angle-double-left'></i> First",
                "last": "Last <i class='fas fa-angle-double-right'></i>"
            },
            "emptyTable": "<div class='text-center py-5'><i class='fas fa-building fa-4x text-muted mb-3'></i><p class='h5 text-muted'>No registrations yet</p><p class='text-muted'>Supplier registrations will appear here.</p></div>"
        },
        "drawCallback": function() {
            $('tbody tr').hover(
                function() { $(this).addClass('table-hover'); },
                function() { $(this).removeClass('table-hover'); }
            );
        },
        "responsive": true,
        "dom": '<"row align-items-center"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "columnDefs": [
            { "orderable": false, "targets": 0 }
        ]
    });

    // Handle company name click to show modal
    $(document).on('click', '.view-details', function(e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var supplierData = JSON.parse(tr.attr('data-supplier'));

        // Populate modal fields
        $('#modal-company_name').text(supplierData.company_name || '—');
        
        if (supplierData.company_website) {
            $('#modal-company_website').text(supplierData.company_website).attr('href', supplierData.company_website);
        } else {
            $('#modal-company_website').text('—').attr('href', '#').removeAttr('target');
        }
        
        $('#modal-company_address').text(supplierData.company_address || '—');
        $('#modal-year_established').text(supplierData.year_established || '—');
        $('#modal-business_type').text(supplierData.business_type || '—');
        
        $('#modal-contact_name').text(supplierData.contact_name || '—');
        $('#modal-job_title').text(supplierData.job_title || '—');
        
        if (supplierData.contact_email) {
            $('#modal-contact_email').text(supplierData.contact_email).attr('href', 'mailto:' + supplierData.contact_email);
        } else {
            $('#modal-contact_email').text('—').attr('href', '#');
        }
        
        if (supplierData.contact_phone) {
            $('#modal-contact_phone').text(supplierData.contact_phone).attr('href', 'tel:' + supplierData.contact_phone);
        } else {
            $('#modal-contact_phone').text('—').attr('href', '#');
        }
        
        $('#modal-product_category').text(supplierData.product_category || '—');
        $('#modal-product_description').text(supplierData.product_description || '—');

        // Documentation - Adjust the asset path as per your storage setup (e.g., storage/app/public/uploads/suppliers/)
        var storagePath = '{{ asset("storage/uploads/suppliers/") }}'; // Update this path if needed
        var brochureHtml = supplierData.brochure ? 
            '<a href="' + storagePath + supplierData.brochure + '" download class="text-primary"><i class="fas fa-download me-1"></i>Download Brochure</a>' : 
            '<span class="text-muted">—</span>';
        $('#modal-brochure').html(brochureHtml);

        var certHtml = supplierData.certifications ? 
            '<a href="' + storagePath + supplierData.certifications + '" download class="text-primary"><i class="fas fa-download me-1"></i>Download Certifications</a>' : 
            '<span class="text-muted">—</span>';
        $('#modal-certifications').html(certHtml);

        // Show modal
        var modal = new bootstrap.Modal(document.getElementById('supplierModal'));
        modal.show();
    });
});

function refreshTable() {
    Swal.fire({
        title: 'Refreshing...',
        text: 'Updating supplier registrations',
        icon: 'info',
        showConfirmButton: false,
        timer: 800,
        timerProgressBar: true
    }).then(() => {
        location.reload();
    });
}
</script>
@endsection