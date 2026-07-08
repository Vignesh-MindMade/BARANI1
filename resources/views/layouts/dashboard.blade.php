@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection

<style>
    :root {
        --primary-bg: #1e2530;
        --secondary-bg: #2a3441;
        --card-bg: #252d3a;
        --text-primary: #ffffff;
        --text-secondary: #8b93a7;
        --accent-blue: #4d9fff;
        --accent-pink: #ff6b9d;
        --accent-green: #4ade80;
        --accent-red: #ef4444;
        --border-color: #343d4d;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        --border-radius: 12px;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--primary-bg);
        color: var(--text-primary);
    }

    .dashboard-container {
        padding: 7% 20%;
        background-color: #f9f7f7;
        /* min-height: 36vh; */
        /* margin: 0 auto; */
        /* max-width: 975px; */
    }
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
    }

    .dashboard-title {
        font-weight: 700;
        color: #000000;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .dashboard-subtitle {
        color: #000000;
        font-size: 1rem;
        font-weight: 400;
    }

    .dashboard-subtitle .user-name {
        color: #104685;
        font-weight: 600;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn-settings,
    .btn-time {
        background-color: var(--secondary-bg);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-settings:hover,
    .btn-time:hover {
        background-color: var(--card-bg);
        border-color: var(--accent-blue);
        color: var(--text-primary);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(77, 159, 255, 0.2);
    }

    /* Clear Cache Button Specific Styles */
    #clearCacheBtn {
           background: linear-gradient(135deg, #1A3D64, #0f2a4a);
        border: none;
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(77, 159, 255, 0.3);
        transition: all 0.3s ease;
     padding: 11px;
    border-radius: 10px;
    }

    #clearCacheBtn:hover {
        background: linear-gradient(135deg, #2d5aa1, var(--accent-blue));
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(77, 159, 255, 0.4);
    }

    /* Stats Cards Enhanced */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        /* background: linear-gradient(145deg, #435663, #34495e); */
        border-radius: var(--border-radius);
        padding: 1.8rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s 
    ease;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
        background: linear-gradient(135deg, #1A3D64, #0f2a4a);
    }


    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, var(--accent-blue), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card:hover {
        transform: translateY(-4px) scale(1.02);
        border-color: var(--accent-blue);
        box-shadow: 0 12px 24px rgba(77, 159, 255, 0.15);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }

    /* Card-Specific Icon Colors */
    .stat-card:nth-child(1) .stat-icon {
        background: rgba(77, 159, 255, 0.15);
        color: var(--accent-blue);
    }

    .stat-card:nth-child(2) .stat-icon {
        background: rgba(34, 197, 94, 0.15);
        color: var(--accent-green);
    }

    .stat-card:nth-child(3) .stat-icon {
        background: rgba(245, 101, 101, 0.15);
        color: var(--accent-red);
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .stat-title {
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-link {
        color: var(--accent-blue);
        font-size: 0.9rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .stat-link:hover {
        color: #60a5fa;
        gap: 0.75rem;
        transform: translateX(4px);
    }

    /* Charts Section (unchanged for now, as no charts in template) */
    .charts-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .chart-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .chart-controls {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .chart-toggle {
        background: var(--secondary-bg);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .chart-toggle.active {
        background: var(--accent-blue);
        color: white;
        border-color: var(--accent-blue);
    }

    .settings-icon {
        color: var(--text-secondary);
        cursor: pointer;
        padding: 0.4rem;
        transition: all 0.3s ease;
    }

    .settings-icon:hover {
        color: var(--accent-blue);
    }

    .metric-card {
        text-align: left;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .metric-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .metric-change {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .metric-change.positive {
        background: rgba(74, 222, 128, 0.1);
        color: var(--accent-green);
    }

    .metric-change.negative {
        background: rgba(239, 68, 68, 0.1);
        color: var(--accent-red);
    }

    .chart-placeholder {
        height: 200px;
        background: var(--secondary-bg);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        margin-top: 1rem;
    }

    /* Enhanced Activity Dropdown */
    .btn-time {
        background: linear-gradient(135deg, #1A3D64, #0f2a4a);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.4rem;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(26, 61, 100, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-time::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s;
    }

    .btn-time:hover::before {
        left: 100%;
    }

    .btn-time:hover {
        background: linear-gradient(135deg, #0f2a4a, #1A3D64);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(26, 61, 100, 0.4);
    }

    /* Dropdown container */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown content - Enhanced Dark Theme */
    .dropdown-content {
        display: none;
        position: absolute;
        background: linear-gradient(145deg, var(--card-bg), #1e2530);
        color: var(--text-primary);
        min-width: 260px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        border-radius: 12px;
        padding: 1.2rem;
        z-index: 1000;
        right: 0;
        top: 50px;
        border: 1px solid var(--border-color);
        animation: fadeInDown 0.3s ease;
        backdrop-filter: blur(10px);
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-content p {
        margin: 0;
        padding: 0.8rem 0;
        font-size: 0.95rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dropdown-content p:last-child {
        border-bottom: none;
    }

    .status-active {
        color: var(--accent-green);
        font-weight: bold;
        text-shadow: 0 0 5px rgba(74, 222, 128, 0.3);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .header-actions {
            width: 100%;
            justify-content: flex-start;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

</style>

@section('wrapper')
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Welcome <span class="user-name">Admin</span>, everything looks great.</p>
            </div>
            <div class="header-actions">
                <button id="clearCacheBtn" class="btn btn-settings">
                    <i class="fas fa-broom"></i> Clear Cache
                </button>
                <!-- Button -->
                <div class="dropdown">
                    <button class="btn-time" id="activityBtn">
                        <i class="fas fa-clock"></i> Activity <i class="fas fa-chevron-down"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-content" id="activityDropdown">
                        <p><strong>Status:</strong> <span id="userStatus" class="status-active">Active</span></p>
                        <p><strong>Current Time:</strong> <span id="currentTime"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $contactCount }}</div>
                <div class="stat-title">ContactUs Form</div>
                <a href="{{ route('contact_view') }}" class="stat-link">
                    View all messages <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $JobApplications }}</div>
                <div class="stat-title">Career</div>
                <a href="{{ route('career_view') }}" class="stat-link">
                    View all Job Applications <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $SupplierRegistrationcount }}</div>
                <div class="stat-title">Supplier</div>
                <a href="{{ route('supplier_view') }}" class="stat-link">
                    View all Suppliers <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $BrochureLeadsCount }}</div>
                <div class="stat-title">Brochure Leads</div>
                <a href="{{ route('brochure_leads_view') }}" class="stat-link">
                    View all Brochure Leads <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Initialize Chart.js for earnings
        const ctx = document.getElementById('earningsChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
                    datasets: [{
                        label: 'This Week',
                        data: [800, 600, 900, 1300, 700, 1100, 1000],
                        backgroundColor: 'rgba(77, 159, 255, 0.3)',
                        borderColor: 'rgba(77, 159, 255, 1)',
                        borderWidth: 2,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)'
                            },
                            ticks: {
                                color: '#8b93a7'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#8b93a7'
                            }
                        }
                    }
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    background: '#252d3a',
                    color: '#ffffff'
                });
            });
        </script>
    @endif

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('clearCacheBtn').addEventListener('click', function() {
            fetch("{{ route('clear.cache') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cache Cleared!',
                            text: data.message,
                            confirmButtonColor: '#1A3D64',
                            background: '#EFECE3',
                            color: '#1A3D64'
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Try again later.',
                        confirmButtonColor: '#1A3D64',
                        background: '#EFECE3',
                        color: '#1A3D64'
                    });
                });
        });
    </script>

    <!-- Enhanced Dropdown Script -->
    <script>
        // Toggle dropdown
        document.getElementById('activityBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('activityDropdown');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.getElementById('activityDropdown').style.display = 'none';
            }
        });

        // Live Time Update
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            document.getElementById('currentTime').textContent = timeString;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>

@endsection