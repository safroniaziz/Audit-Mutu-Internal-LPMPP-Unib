    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/new-address.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

    <!--begin::Activity Log JavaScript-->
    <script>
        // Activity Log Management
        class ActivityLog {
            constructor() {
                this.activities = [];
                this.unreadCount = 0;
                this.totalCount = 0;
                this.isLoading = false;
                this.init();
            }

            init() {
                this.bindEvents();
                this.loadActivities();
                this.startAutoRefresh();
            }

            bindEvents() {
                // Activity log toggle
                const activityToggle = document.getElementById('kt_activity_log_toggle');
                if (activityToggle) {
                    activityToggle.addEventListener('click', () => {
                        this.showActivityLog();
                    });
                }



                // Refresh activities
                const refreshBtn = document.getElementById('refresh-activities');
                if (refreshBtn) {
                    refreshBtn.addEventListener('click', () => {
                        this.loadActivities();
                    });
                }

                // Close drawer
                const closeBtn = document.getElementById('kt_activities_close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        this.hideActivityLog();
                    });
                }
            }

                        async loadActivities() {
                if (this.isLoading) return;

                this.isLoading = true;
                this.showLoading();

                try {
                    // Get CSRF token
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Fetch activities from API
                    const response = await fetch('/activity-log/get-activities', {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();

                    if (result.success) {
                        this.activities = result.data.activities;
                        this.unreadCount = result.data.unread_count;
                        this.totalCount = result.data.total_count;

                        // Update stats
                        this.updateStats();
                    } else {
                        throw new Error(result.message || 'Gagal memuat aktivitas');
                    }

                    // Hide loading
                    this.hideLoading();

                } catch (error) {
                    console.error('Error loading activities:', error);
                    this.hideLoading();
                    this.showError();
                }
            }

            updateStats() {
                const totalElement = document.getElementById('total-activities');
                const unreadElement = document.getElementById('unread-activities');
                const counterElement = document.getElementById('activity-counter');
                const indicatorElement = document.getElementById('activity-indicator');

                if (totalElement) totalElement.textContent = this.totalCount;
                if (unreadElement) unreadElement.textContent = this.unreadCount;

                // Update counter badge
                if (counterElement) {
                    if (this.unreadCount > 0) {
                        counterElement.textContent = this.unreadCount;
                        counterElement.style.display = 'flex';
                    } else {
                        counterElement.style.display = 'none';
                    }
                }

                // Update indicator
                if (indicatorElement) {
                    if (this.unreadCount > 0) {
                        indicatorElement.style.display = 'block';
                    } else {
                        indicatorElement.style.display = 'none';
                    }
                }

                // Update activity list
                this.renderActivities();
            }

            renderActivities() {
                const container = document.getElementById('activity-items-container');
                if (!container) return;

                if (this.activities.length === 0) {
                    this.showEmptyState();
                    return;
                }

                                 const activitiesHTML = this.activities.map(activity => `
                     <div class="activity-item d-flex align-items-start p-3 rounded mb-3 ${activity.isUnread ? 'unread' : ''}" data-activity-id="${activity.id}">
                         <div class="activity-icon me-3">
                             <i class="${activity.icon} ${activity.color}"></i>
                         </div>
                         <div class="flex-grow-1">
                             <div class="d-flex justify-content-between align-items-start mb-1">
                                 <h6 class="text-dark fw-semibold mb-0">${activity.title}</h6>
                                 ${activity.isUnread ? '<span class="badge bg-success fs-8">Baru</span>' : ''}
                             </div>
                             <p class="text-muted fs-7 mb-1">${activity.description}</p>
                             <div class="activity-time">
                                 <i class="fas fa-clock me-1"></i>
                                 ${activity.time}
                             </div>
                         </div>
                     </div>
                 `).join('');

                container.innerHTML = activitiesHTML;
                this.hideEmptyState();
            }

            showLoading() {
                const loadingElement = document.getElementById('activity-loading');
                const container = document.getElementById('activity-items-container');

                if (loadingElement) loadingElement.style.display = 'block';
                if (container) container.style.display = 'none';
            }

            hideLoading() {
                const loadingElement = document.getElementById('activity-loading');
                const container = document.getElementById('activity-items-container');

                if (loadingElement) loadingElement.style.display = 'none';
                if (container) container.style.display = 'block';
            }

            showEmptyState() {
                const emptyElement = document.getElementById('activity-empty');
                const container = document.getElementById('activity-items-container');

                if (emptyElement) emptyElement.style.display = 'block';
                if (container) container.style.display = 'none';
            }

            hideEmptyState() {
                const emptyElement = document.getElementById('activity-empty');
                if (emptyElement) emptyElement.style.display = 'none';
            }

                         showError() {
                 const container = document.getElementById('activity-items-container');
                 if (container) {
                     container.innerHTML = `
                         <div class="text-center py-8">
                             <div class="symbol symbol-60px mx-auto mb-4">
                                 <div class="symbol-label bg-light-warning">
                                     <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
                                 </div>
                             </div>
                             <h4 class="text-dark mb-2">Terjadi Kesalahan</h4>
                             <p class="text-muted">Gagal memuat aktivitas. Silakan coba lagi.</p>
                         </div>
                     `;
                 }
             }

                        async markAllAsRead() {
                try {
                    // Get CSRF token
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Call API to mark all as read
                    const response = await fetch('/activity-log/mark-all-read', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();

                    if (result.success) {
                        // Update local state
                        this.activities.forEach(activity => {
                            activity.isUnread = false;
                        });
                        this.unreadCount = 0;
                        this.updateStats();

                        // Show success message
                        this.showToast(result.message || 'Semua aktivitas telah ditandai sebagai dibaca', 'success');
                    } else {
                        throw new Error(result.message || 'Gagal menandai aktivitas');
                    }

                } catch (error) {
                    console.error('Error marking activities as read:', error);
                    this.showToast('Gagal menandai aktivitas sebagai dibaca', 'danger');
                }
            }

            showActivityLog() {
                // The drawer will be shown automatically by the data-kt-drawer-toggle attribute
                // We can add additional logic here if needed
            }

            hideActivityLog() {
                // The drawer will be hidden automatically by the data-kt-drawer-close attribute
                // We can add additional logic here if needed
            }

            startAutoRefresh() {
                // Refresh activities every 30 seconds
                setInterval(() => {
                    this.loadActivities();
                }, 30000);
            }

            showToast(message, type = 'info') {
                // Simple toast notification
                const toast = document.createElement('div');
                toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                toast.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;

                document.body.appendChild(toast);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 3000);
            }

            // Public method to add new activity
            addActivity(activity) {
                this.activities.unshift(activity);
                this.totalCount++;
                if (activity.isUnread) {
                    this.unreadCount++;
                }
                this.updateStats();
            }
        }

        // Initialize Activity Log when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.activityLog = new ActivityLog();

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <!--end::Activity Log JavaScript-->
