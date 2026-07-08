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

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
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

    .lead-name {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--text-dark);
        gap: 0.5rem;
        cursor: pointer;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .lead-name:hover {
        color: var(--primary-blue-light);
    }

    .lead-name i {
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

    .company-badge {
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
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: var(--text-dark);
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .dataTables_wrapper .dataTables_length select {
        border: 2px solid var(--border-color);
        border-radius: var(--radius-sm);
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: var(--text-dark);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-color);
        background: white;
        color: var(--primary-blue);
        cursor: pointer;
        transition: all 0.2s ease;
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
        font-weight: 600;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-xl);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
        border: none;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        padding: 1.5rem 2rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.7;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-body {
        padding: 2rem;
        color: var(--text-dark);
    }

    .modal-body h6 {
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        margin-top: 1rem;
    }

    .modal-body h6:first-child {
        margin-top: 0;
    }

    .modal-body p {
        font-size: 1rem;
        color: var(--text-dark);
        margin: 0 0 1rem 0;
        font-weight: 500;
    }

    .modal-body strong {
        font-weight: 700;
        color: var(--primary-blue);
    }

    .modal-body a {
        color: var(--primary-blue);
        text-decoration: none;
    }

    .modal-body a:hover {
        text-decoration: underline;
        color: var(--primary-blue-light);
    }

    .modal-body .border {
        border-top: 2px solid var(--border-color) !important;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 1.5rem 2rem;
        background: var(--bg-light);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-content {
            padding: 0 1rem;
        }

        .page-box {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .stats-header {
            grid-template-columns: 1fr;
        }

        .card-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .card-header h5 {
            width: 100%;
        }

        .card-header .btn-group {
            width: 100%;
        }

        .card-header .btn-group .btn {
            flex: 1;
            justify-content: center;
        }

        .table {
            font-size: 0.75rem;
        }

        .table tbody td {
            padding: 0.875rem 1rem;
        }

        .table thead th {
            padding: 1rem 0.875rem;
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
        animation: fadeIn 0.5s ease;
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
        <div class="page-box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-file-download" style="color: var(--primary-blue-dark);"></i>
                        Brochure Downloads
                    </h1>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Brochure Downloads</li>
                </ol>
            </nav>
        </div>

        <!-- Stats Header -->
        <div class="stats-header">
            <div class="stats-item">
                <span class="stats-number">{{ $BrochureLeadsCount }}</span>
                <span class="stats-label">Total Downloads</span>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-table"></i>
                    Download Records
                </h5>
                <div class="btn-group">
                    <a href="{{ route('export_brochure_leads') }}" class="btn btn-success">
                        <i class="fas fa-download"></i>
                        Export to Excel
                    </a>
                    <button class="btn btn-light" onclick="location.reload()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="brochureLeadsTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th style="width: 15%;">Name</th>
                                <th style="width: 20%;">Company</th>
                                <th style="width: 20%;">Email</th>
                                <th style="width: 15%;">Phone</th>
                                <th style="width: 15%;">Country</th>
                                <th style="width: 15%;">Download Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($BrochureLeads as $index => $lead)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <div class="lead-name" onclick="viewLeadDetails({{ $lead->id }})" style="cursor: pointer;">
                                        <i class="fas fa-user-circle"></i>
                                        {{ $lead->name }}
                                    </div>
                                </td>
                                <td>
                                    <span class="company-badge">
                                        @if($lead->company_name)
                                            {{ Str::limit($lead->company_name, 20) }}
                                        @else
                                            <span style="color: var(--text-muted);">Not provided</span>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="mailto:{{ $lead->email }}" class="contact-email">
                                        <i class="fas fa-envelope"></i>
                                        {{ $lead->email }}
                                    </a>
                                </td>
                                <td>
                                    @if($lead->phone_no)
                                        <a href="tel:{{ $lead->phone_no }}" style="color: var(--primary-blue); text-decoration: none;">
                                            <i class="fas fa-phone"></i> {{ $lead->phone_no }}
                                        </a>
                                    @else
                                        <span style="color: var(--text-muted);">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lead->country)
                                        <span style="color: var(--text-dark); font-weight: 500;">{{ $lead->country }}</span>
                                    @else
                                        <span style="color: var(--text-muted);">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="contact-date">
                                        {{ $lead->created_at->format('M d, Y') }}
                                        <small>{{ $lead->created_at->format('h:i A') }}</small>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 3rem 1.5rem; color: var(--text-muted);">
                                    <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                                    <p style="margin: 0;">No brochure downloads yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="leadDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle"></i>
                    Lead Details
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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
    $('#brochureLeadsTable').DataTable({
        "order": [[6, 'desc']],
        "pageLength": 25,
        "responsive": true,
        "columnDefs": [
            {"orderable": false, "targets": 0}
        ]
    });
});

function viewLeadDetails(leadId) {
    // Create a lead details row from table data
    const row = event.target.closest('tr');
    const cells = row.querySelectorAll('td');
    
    const html = `
        <div style="text-align: left;">
            <h6>Personal Information</h6>
            <p><strong>Name:</strong> ${cells[1].textContent.trim()}</p>
            <p><strong>Email:</strong> ${cells[3].textContent.trim()}</p>
            <p><strong>Phone:</strong> ${cells[4].textContent.trim() || 'Not provided'}</p>
            
            <div class="border"></div>
            
            <h6>Company Information</h6>
            <p><strong>Company Name:</strong> ${cells[2].textContent.trim() || 'Not provided'}</p>
            <p><strong>Country:</strong> ${cells[5].textContent.trim() || 'Not provided'}</p>
            
            <div class="border"></div>
            
            <h6>Download Information</h6>
            <p><strong>Download Date:</strong> ${cells[6].textContent.trim()}</p>
        </div>
    `;
    
    $('#modalContent').html(html);
    $('#leadDetailsModal').modal('show');
}

function refreshTable() {
    Swal.fire({
        title: 'Refreshing...',
        text: 'Loading latest data',
        icon: 'info',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
        timerProgressBar: true,
        timer: 1500
    }).then(() => {
        location.reload();
    });
}

// Show success message if export was triggered
@if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        timer: 3000,
        timerProgressBar: true
    });
@endif
</script>
@endsection
