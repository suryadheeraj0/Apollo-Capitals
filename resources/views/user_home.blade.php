<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <style>
        .scrolling-text {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;
        }
 
        .scrolling-text span {
            display: inline-block;
            padding-left: 100%;
            animation: scroll 10s linear infinite;
        }
 
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
 
            100% {
                transform: translateX(-100%);
            }
        }
 
        .vertical-nav {
            width: 300px;
            /* Adjusted width */
            background-color: #343a40;
            padding-top: 30px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }
 
        .vertical-nav a.nav-link {
            color: white;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 5px;
        }
 
        .vertical-nav a.nav-link:hover {
            background-color: #495057;
            color: white;
        }
 
        .main-content {
            margin-left: 320px;
            /* Adjusted to match the new sidebar width */
            padding: 20px;
        }
 
        .sub-menu {
            display: none;
            padding-left: 20px;
        }
 
        .sub-menu a.nav-link {
            font-size: 0.9rem;
        }
    </style>
</head>
 
<body>
    
    <div class="vertical-nav">
        @role([\App\Enums\Roles::User, \App\Enums\Roles::AccountManager])
        {{--<h4 class="text-white text-center"><i>Task and Diary Management</i></h4>--}}
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="toggleSubMenu('task-diary-management')"><i>Task
                        Management and Diary Management</i></a>
                <div id="task-diary-management" class="sub-menu">
                    <a class="nav-link" href="{{ route('show.create', $user->id) }}"><i>Create Task</i></a>
                    <a class="nav-link" href="{{ route('show.index') }}"><i>List of Tasks</i></a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="toggleSubMenu('customer-management')"><i>Customer
                        Management</i></a>
                <div id="customer-management" class="sub-menu">
                    <a class="nav-link" href="{{ route('create_cust_data1') }}"><i>Create Customer</i></a>
                    <a class="nav-link" href="{{ route('create_cust1') }}"><i>List of Customers</i></a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="toggleSubMenu('appointment-management')"><i>Appointment
                        Management</i></a>
                <div id="appointment-management" class="sub-menu">
                    <a class="nav-link" href="{{ route('show_appoint') }}"><i>Create Appointment</i></a>
                    <a class="nav-link" href="{{ route('show_customer_appointment') }}"><i>List of Appointments</i></a>
                </div>
            </li>
            @can('show activity log')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('show-activity-logs-user') }}"
                    onclick="toggleSubMenu('admin-panel')"><i>Activity Log</i></a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit') }}"
                    onclick="toggleSubMenu('admin-panel')"><i>Your Profile</i></a>
            </li>
            @endrole
            @role(\App\Enums\Roles::Admin)
            <!-- Admin Panel Section -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_dashboard') }}"
                    onclick="toggleSubMenu('admin-panel')"><i>Admin Panel</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('show-activity-logs-admin') }}"
                    onclick="toggleSubMenu('admin-panel')"><i>Activity Log</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit') }}"
                    onclick="toggleSubMenu('admin-panel')"><i>Your Profile</i></a>
            </li>
            @endrole
        </ul>
    </div>
 
    <div class="main-content">
        <h1 class="text-center"><i><strong>Home Page</strong></i></h1>
        <p class="text-center"><i>Hi {{auth()->user()->name}}, welcome to this page!</i></p>
        <div class="scrolling-text text-center">
            <span><i>Here you can manage different sections of the application.</i></span>
        </div>
    </div>
 
    <script>
        function toggleSubMenu(menuId) {
            var subMenu = document.getElementById(menuId);
            if (subMenu.style.display === "none" || subMenu.style.display === "") {
                subMenu.style.display = "block";
            } else {
                subMenu.style.display = "none";
            }
        }
    </script>
 
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
 
</html>
 