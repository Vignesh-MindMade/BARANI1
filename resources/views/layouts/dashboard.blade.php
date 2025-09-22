@extends('layouts.app')

@section('content')

<title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div class="header-info">
                <div class="datetime" id="datetime"></div>
              <button class="clear-cache-btn" onclick="clearCache()">
                Clear Cache
            </button>

            </div>
        </div>

        <!-- Stats Row -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number">24</div>
                <div class="stat-label">New Emails</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">12</div>
                <div class="stat-label">Pending Inquiries</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">156</div>
                <div class="stat-label">Total Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">98%</div>
                <div class="stat-label">Response Rate</div>
            </div>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- New Email Received Section -->
            <div class="card">
                <h2>New Emails</h2>
                <div class="email-list scrollbar-custom">
                    <div class="email-item unread">
                        <div class="email-header">
                            <div class="email-sender">John Smith</div>
                            <div class="email-time">2 min ago</div>
                        </div>
                        <div class="email-subject">Product Inquiry - Enterprise Package</div>
                        <div class="email-preview">Hi, I'm interested in your enterprise package and would like to know
                            more about pricing and features...</div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-new">New</span>
                        </div>
                    </div>

                    <div class="email-item unread">
                        <div class="email-header">
                            <div class="email-sender">Sarah Johnson</div>
                            <div class="email-time">15 min ago</div>
                        </div>
                        <div class="email-subject">Support Request - Login Issues</div>
                        <div class="email-preview">I'm having trouble logging into my account. The password reset isn't
                            working...</div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-new">New</span>
                        </div>
                    </div>

                    <div class="email-item">
                        <div class="email-header">
                            <div class="email-sender">Mike Davis</div>
                            <div class="email-time">1 hour ago</div>
                        </div>
                        <div class="email-subject">Partnership Proposal</div>
                        <div class="email-preview">We'd like to discuss a potential partnership opportunity with your
                            company...</div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-read">Read</span>
                        </div>
                    </div>

                    <div class="email-item unread">
                        <div class="email-header">
                            <div class="email-sender">Lisa Chen</div>
                            <div class="email-time">2 hours ago</div>
                        </div>
                        <div class="email-subject">Feature Request</div>
                        <div class="email-preview">Could you please add a dark mode option to the dashboard? It would be
                            really helpful...</div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-new">New</span>
                        </div>
                    </div>

                    <div class="email-item">
                        <div class="email-header">
                            <div class="email-sender">Alex Rodriguez</div>
                            <div class="email-time">3 hours ago</div>
                        </div>
                        <div class="email-subject">Billing Question</div>
                        <div class="email-preview">I have a question about my recent invoice. The charges don't seem
                            correct...</div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-read">Read</span>
                        </div>
                    </div>

                    <div class="email-item unread">
                        <div class="email-header">
                            <div class="email-sender">Emma Wilson</div>
                            <div class="email-time">5 hours ago</div>
                        </div>
                        <div class="email-subject">Account Upgrade Request</div>
                        <div class="email-preview">I'd like to upgrade my account to the premium plan. What's the
                            process?</div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-new">New</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inquiry Details Section -->
            <div class="card">
                <h2>Inquiry Details</h2>
                <div class="inquiry-details scrollbar-custom">
                    <div class="inquiry-item">
                        <div class="inquiry-header">
                            <div class="inquiry-id">#INQ-2024-001</div>
                            <div class="inquiry-status status-pending">Pending</div>
                        </div>
                        <div class="inquiry-content">
                            <strong>Customer:</strong> John Smith<br>
                            <strong>Type:</strong> Product Inquiry<br>
                            <strong>Priority:</strong> High<br><br>
                            <strong>Message:</strong> I need detailed information about your enterprise package,
                            including pricing tiers, features, and implementation timeline. We're looking to onboard
                            500+ users.
                        </div>
                        <div class="inquiry-meta">
                            <span>john.smith@company.com</span>
                            <span>+1-555-0123</span>
                            <span>2 min ago</span>
                        </div>
                    </div>

                    <div class="inquiry-item">
                        <div class="inquiry-header">
                            <div class="inquiry-id">#INQ-2024-002</div>
                            <div class="inquiry-status status-in-progress">In Progress</div>
                        </div>
                        <div class="inquiry-content">
                            <strong>Customer:</strong> Sarah Johnson<br>
                            <strong>Type:</strong> Technical Support<br>
                            <strong>Priority:</strong> Medium<br><br>
                            <strong>Message:</strong> Login issues persist after password reset. Account shows as
                            locked. Need immediate assistance as this is affecting my daily work.
                        </div>
                        <div class="inquiry-meta">
                            <span>sarah.j@email.com</span>
                            <span>+1-555-0456</span>
                            <span>15 min ago</span>
                        </div>
                    </div>

                    <div class="inquiry-item">
                        <div class="inquiry-header">
                            <div class="inquiry-id">#INQ-2024-003</div>
                            <div class="inquiry-status status-resolved">Resolved</div>
                        </div>
                        <div class="inquiry-content">
                            <strong>Customer:</strong> Mike Davis<br>
                            <strong>Type:</strong> Partnership<br>
                            <strong>Priority:</strong> Low<br><br>
                            <strong>Message:</strong> Interested in exploring partnership opportunities. We have a
                            complementary product that could benefit both our user bases.
                        </div>
                        <div class="inquiry-meta">
                            <span>mike@partnercorp.com</span>
                            <span>+1-555-0789</span>
                            <span>1 hour ago</span>
                        </div>
                    </div>

                    <div class="inquiry-item">
                        <div class="inquiry-header">
                            <div class="inquiry-id">#INQ-2024-004</div>
                            <div class="inquiry-status status-pending">Pending</div>
                        </div>
                        <div class="inquiry-content">
                            <strong>Customer:</strong> Lisa Chen<br>
                            <strong>Type:</strong> Feature Request<br>
                            <strong>Priority:</strong> Low<br><br>
                            <strong>Message:</strong> Would love to see a dark mode option in the dashboard. Many users
                            work in low-light environments and this would improve usability.
                        </div>
                        <div class="inquiry-meta">
                            <span>lisa.chen@tech.com</span>
                            <span>+1-555-0321</span>
                            <span>2 hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function clearCache() {
        fetch("{{ route('clear.cache') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Failed to clear cache!"
            });
            console.error("Error:", error);
        });
    }
</script>


    <script>
        // Update date and time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('datetime').textContent = now.toLocaleDateString('en-US', options);
        }

        // Event delegation for email items
        document.querySelector('.email-list').addEventListener('click', function(e) {
            const item = e.target.closest('.email-item');
            if (!item) return;
            if (item.classList.contains('unread')) {
                item.classList.remove('unread');
                const badge = item.querySelector('.status-badge');
                badge.textContent = 'Read';
                badge.className = 'status-badge status-read';
                const newEmailsCount = document.querySelector('.stats-row .stat-number');
                let count = parseInt(newEmailsCount.textContent);
                if (count > 0) {
                    newEmailsCount.textContent = count - 1;
                }
            }
        });

        // Initialize
        updateDateTime();
        const dateTimeInterval = setInterval(updateDateTime, 5000);

        // Card hover animations
        const cards = document.querySelectorAll('.card, .stat-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-2px)');
            card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
        });

        // Debounced real-time updates
        let isUpdating = false;

        function updateNewItems() {
            if (isUpdating) return;
            isUpdating = true;
            const newItems = document.querySelectorAll('.unread, .status-pending');
            newItems.forEach(item => {
                item.classList.add('pulse');
                setTimeout(() => item.classList.remove('pulse'), 1500);
            });
            isUpdating = false;
        }

        setInterval(updateNewItems, 60000);

        // Add pulse animation class
        const style = document.createElement('style');
        style.textContent = `
            .pulse {
                animation: pulse 1.5s ease-in-out;
            }
        `;
        document.head.appendChild(style);

        // Cleanup intervals on page unload
        window.addEventListener('unload', () => {
            clearInterval(dateTimeInterval);
        });
    </script>
@endsection