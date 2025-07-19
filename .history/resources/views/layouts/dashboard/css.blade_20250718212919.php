    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/src/images/logo_unib.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Menjaga tombol agar rata tengah */
            gap: 8px; /* Memberikan jarak antar tombol */
        }

        .button-container .btn {
            flex: 1 1 auto; /* Tombol bisa menyusut dan berkembang */
            min-width: 80px; /* Tentukan lebar minimum tombol */
            max-width: 150; /* Menambahkan batasan lebar maksimum */
        }

        @media (max-width: 576px) {
            .button-container {
                flex-direction: column; /* Pada layar kecil, tombol ditata dalam kolom */
                align-items: center; /* Rata tengah secara vertikal */
            }

            .button-container .btn {
                width: auto; /* Tombol akan mengambil lebar yang sesuai dengan kontennya */
                max-width: 150px; /* Membatasi lebar tombol pada layar kecil */
            }
        }

        .custom-swal-button {
            padding-top: .8rem;
            padding-bottom: .8rem;
        }

        /* Activity Log Button Styling */
        #kt_activity_log_toggle {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        #kt_activity_log_toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            border-color: rgba(0, 123, 255, 0.2);
        }

        #kt_activity_log_toggle:active {
            transform: translateY(0);
        }

        /* Activity Counter Badge */
        #activity-counter {
            font-size: 0.7rem !important;
            font-weight: 600;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: badgePulse 2s infinite;
        }

        /* Activity Indicator */
        #activity-indicator {
            animation: pulse 2s infinite;
        }

        /* Animations */
        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.7;
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

        @keyframes badgePulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.1);
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
            }
        }

        /* Activity Log Drawer Styling */
        .activity-log-drawer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .activity-log-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .activity-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-left-color: #007bff;
            transform: translateX(5px);
        }

        .activity-item.unread {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #28a745;
        }

        .activity-time {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }
    </style>
