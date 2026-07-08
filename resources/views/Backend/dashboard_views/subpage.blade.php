@extends("layouts.app") 
@section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .page-content {
        min-height: 100vh;
        padding: 40px 20px;
    }

    .page-header {
        background: #1e3556;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        backdrop-filter: blur(10px);
    }

    .page-header h2 {
       background: white;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 2.5rem;
        margin: 0;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .page-box {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(10px);
    }

    #example {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    #example thead th {
        background: #1e3556;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 15px;
        border: none;
        font-size: 0.9rem;
    }

    #example tbody tr {
        transition: all 0.3s ease;
        background: white;
    }

    #example tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    #example tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
        color: #333;
    }

    #example tbody tr:last-child td {
        border-bottom: none;
    }

    .view-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 25px;
         background: #1e3556;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        font-size: 0.9rem;
    }

    .view-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        color: white;
        text-decoration: none;
    }

    .view-btn i {
        font-size: 0.85rem;
    }

    .serial-number {
        width: 60px;
        height: 60px;
       background: #1e3556;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .page-name {
        font-weight: 600;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #5670e3;
        font-size: 1.2rem;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_length select:focus,
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        border-color: transparent !important;
        color: white !important;
        border-radius: 8px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%) !important;
        border-color: transparent !important;
        color: #667eea !important;
    }

    .dataTables_wrapper .dataTables_info {
        color: #64748b;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 1.8rem;
        }

        .page-box {
            padding: 20px;
        }

        .serial-number {
            width: 45px;
            height: 45px;
            font-size: 1rem;
        }

        .page-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
    }
</style>
@endsection

@section("wrapper")

<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-header text-center">
                        <h2>
                            <i class="fas fa-file-alt" style="font-size: 80%;"></i> Page Management
                        </h2>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="page-box">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th>Page Name</th>
                                        <th class="text-center" style="width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">1</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-home"></i>
                                                </span>
                                                <span>Home Page</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('testCurricular.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">2</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span>About Us</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('facilties.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">3</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                                <span>Barani Group</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('groupsubmenu.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                                                        <tr>
                                        <td class="text-center">
                                            <span class="serial-number">4</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                                <span>JSR</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('jsr.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">5</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-truck"></i>
                                                </span>
                                                <span>Supplier Space</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('supplier_space.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">6</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-leaf"></i>
                                                </span>
                                                <span>Sustainability</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('sustainability.backend') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">7</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-cogs"></i>
                                                </span>
                                                <span>Capabilities</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('capsubmenu.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="serial-number">8</span>
                                        </td>
                                        <td>
                                            <div class="page-name">
                                                <span class="page-icon">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <span>Contact Us</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('contactussss.index') }}" class="view-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("script")
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function () {
        $("#example").DataTable({
            "pageLength": 5,
            "language": {
                "search": "Search pages:",
                "lengthMenu": "Show _MENU_ pages",
                "info": "Showing _START_ to _END_ of _TOTAL_ pages",
                "paginate": {
                    "previous": "← Previous",
                    "next": "Next →"
                }
            }
        });
    });
</script>

@endsection