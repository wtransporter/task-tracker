<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- Datetimepicker --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <!-- CoreUI CSS -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('css/coreui.min.css')}}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
        integrity="sha512-n+g8P11K/4RFlXnx2/RW1EZK25iYgolW6Qn7I0F96KxJibwATH3OoVCQPh/hzlc4dWAwplglKX8IVNVMWUUdsw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles

    <script>
    var editor_config = {
        height: 300,
        // width: 900,   
        path_absolute : "/",
        // selector: "textarea.my-editor",
        selector:'textarea.my-editor:not(.myEditor)',
                valid_elements : '*[*]',
            //     valid_styles: {
            //   '*': 'border,font-size,color,background-color,text-align',
            //   'div': 'width,height'
            // },

        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        cleanup: false,
        verify_html: false,
        content_css: [
        '{{ URL('/css/coreui.min.css') }}',
        '{{ URL('/css/app.css') }}',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'
        ],    
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };

    tinymce.init(editor_config);
    </script>
</head>

<body class="c-app">
    @include('partials.sidebar')

    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
            </svg>
        </button>
            <ul class="c-header-nav d-md-down-none">
                <li class="c-header-nav-item px-3">
                    <a class="c-header-nav-link {{ request()->routeIs('home') ? 'text-primary' : '' }}" href="{{ route('home') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="c-header-nav-item px-3">
                    <a class="c-header-nav-link {{ request()->routeIs('user-tasks') ? 'text-primary' : '' }}" href="{{ route('user-tasks') }}">
                        {{ __('My Tasks') }}
                    </a>
                </li>
                <li class="c-header-nav-item px-3">
                    <a class="c-header-nav-link {{ request()->routeIs('activities') ? 'text-primary' : '' }}" href="{{ route('activities') }}">
                        {{ __('Activity Log') }}
                    </a>
                </li>
            </ul>
            <ul class="c-header-nav ml-auto mr-4">
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <a class="c-header-nav-link {{ request()->routeIs('notifications') ? 'text-primary' : '' }}" href="{{ route('notifications') }}">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                        </svg><span class="badge badge-danger ml-auto rounded-circle">{{ $count['notifications'] }}</span>
                    </a>
                </li>
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                        </svg>
                    </a>
                </li>
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                        </svg>
                    </a>
                </li>
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="{{ Auth::user()->avatar ? asset('storage') .'/'. Auth::user()->avatar : asset('img/no-image.png') }}"
                                alt="user@email.com">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                        <a class="dropdown-item {{ request()->routeIs('notifications') ? 'text-primary' : '' }}" href="{{ route('notifications') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                            </svg> {{ __('Updates') }}<span class="badge badge-danger ml-auto">{{ $count['notifications'] }}</span>
                        </a>
                        {{-- <a class="dropdown-item"
                            href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                            </svg> Messages<span class="badge badge-success ml-auto">42</span>
                        </a> --}}
                        <a class="dropdown-item {{ request()->routeIs('user-tasks') ? 'text-primary' : '' }}" href="{{ route('user-tasks') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-task') }}"></use>
                            </svg> {{ __('Tasks') }}<span class="badge badge-danger ml-auto">{{ $count['tasks'] }}</span>
                        </a>
                        {{-- <a class="dropdown-item"
                            href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-comment-square') }}"></use>
                            </svg> Comments<span class="badge badge-warning ml-auto">42</span>
                        </a> --}}
                        <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                        <a
                            class="dropdown-item" href="{{ route('user.edit') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                            </svg> Profile
                        </a>
                        @if(Auth::user()->is_admin)
                        <a class="dropdown-item" href="{{ route('backups') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-settings') }}"></use>
                            </svg> Settings
                        </a>
                        @endif
                        {{-- <a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-credit-card') }}"></use>
                            </svg> Payments<span class="badge badge-secondary ml-auto">42</span>
                        </a>
                        <a
                            class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
                            </svg> Projects<span class="badge badge-primary ml-auto">42</span>
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                            </svg> Lock Account
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
                            </svg> {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </header>
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        {{ $slot }}
                    </div>
                </div>
            </main>
            <footer class="c-footer">
                <div><a href="https://coreui.io">CoreUI</a> ?? 2020 creativeLabs.</div>
                <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
            </footer>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then CoreUI JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"
        integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    {{-- <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script> --}}
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    @livewireScripts

    <!-- Sweetalert -->
    @include('sweetalert::alert')

    <script>
        window.addEventListener('swal', function(e) {
            console.log(e.detail);
            const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: 'success',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire(e.detail);
        });
        
        moment.updateLocale('en', {
            week: {dow: 1} // Monday is the first day of the week
        })

        $('.date').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'en',
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            }
        })

        $('.datetime').datetimepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            locale: 'en',
            sideBySide: true,
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            }
        })

        $('.timepicker').datetimepicker({
            format: 'HH:mm:ss',
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            }
        })

        window.addEventListener('closeModal', event => {
            $('#newTaskModal').modal('hide');
        })

    </script>
    @stack('scripts')
</body>

</html>