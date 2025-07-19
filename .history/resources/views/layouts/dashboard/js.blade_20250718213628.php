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

                // Mark all as read
                const markAllReadBtn = document.getElementById('mark-all-read');
                if (markAllReadBtn) {
                    markAllReadBtn.addEventListener('click', () => {
                        this.markAllAsRead();
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
                    // Simulate API call - replace with actual API endpoint
                    await this.simulateApiCall();

                    // Update stats
                    this.updateStats();

                    // Hide loading
                    this.hideLoading();

                } catch (error) {
                    console.error('Error loading activities:', error);
                    this.hideLoading();
                    this.showError();
                }
            }

            async simulateApiCall() {
                // Simulate API delay
                await new Promise(resolve => setTimeout(resolve, 1000));

                // Sample activities data
                this.activities = [
                    {
                        id: 1,
                        type: 'assignment',
                        title: 'Penugasan Auditor Baru',
                        description: 'Auditor John Doe ditugaskan untuk audit Fakultas Teknik',
                        time: '2 menit yang lalu',
                        isUnread: true,
                        icon: 'fas fa-user-plus',
                        color: 'text-success'
                    },
                    {
                        id: 2,
                        type: 'document',
                        title: 'Dokumen Audit Diunggah',
                        description: 'Laporan audit periode 2024 telah diunggah',
                        time: '1 jam yang lalu',
                        isUnread: false,
                        icon: 'fas fa-file-alt',
                        color: 'text-info'
                    },
                    {
                        id: 3,
                        type: 'status',
                        title: 'Status Audit Diperbarui',
                        description: 'Status audit Fakultas Ekonomi berubah menjadi "Selesai"',
                        time: '3 jam yang lalu',
                        isUnread: false,
                        icon: 'fas fa-check-circle',
                        color: 'text-warning'
                    },
                    {
                        id: 4,
                        type: 'team',
                        title: 'Tim Auditor Dibentuk',
                        description: 'Tim auditor untuk audit Fakultas Hukum telah dibentuk',
                        time: '1 hari yang lalu',
                        isUnread: false,
                        icon: 'fas fa-users',
                        color: 'text-primary'
                    }
                ];

                this.unreadCount = this.activities.filter(activity => activity.isUnread).length;
                this.totalCount = this.activities.length;
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
                                <div class="symbol-label bg-white bg-opacity-10">
                                    <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
                                </div>
                            </div>
                            <h4 class="text-white mb-2">Terjadi Kesalahan</h4>
                            <p class="text-white-50">Gagal memuat aktivitas. Silakan coba lagi.</p>
                        </div>
                    `;
                }
            }

            markAllAsRead() {
                this.activities.forEach(activity => {
                    activity.isUnread = false;
                });
                this.unreadCount = 0;
                this.updateStats();

                // Show success message
                this.showToast('Semua aktivitas telah ditandai sebagai dibaca', 'success');
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
