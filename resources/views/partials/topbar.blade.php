<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <div>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group search">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for Music" name="search" id="search" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    </div>
    <ul class="search-result list-group"></ul>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>


            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                               placeholder="Search for..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </li>

        @php $notifications = auth()->user()->unreadNotifications; @endphp
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>

                    @if($notifications->count() > 0)
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">{{ $notifications->count() }}</span>
                    @endif
                </a>

                <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        @forelse($notifications as $notification)
                            <a class="dropdown-item d-flex align-items-center mark-as-read" data-id="{{ $notification->id }}" href="{{ route('suggest.index') }}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{$notification->created_at}}</div>
                                    <span class="font-weight-bold">{{$notification->data['suggest_message']}}</span>
                                </div>
                            </a>
                        @empty

                    @endforelse

                </div>
            </li>



        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin Admin</span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin_user.index') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Nastroýka
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ulgamdan çyk
                </a>
            </div>
        </li>

    </ul>

</nav>

@push('scripts')

    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('admin.markNotification') }}", {
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function(e) {
            event.preventDefault();
            let href = this.href;
            let request = sendMarkRequest($(this).data('id'));
            window.location = href;
        });

        // $('#mark-all').click(function() {
        //     let request = sendMarkRequest();
        //     request.done(() => {
        //         $('div.alert').remove();
        //     })
        // });
    });
    </script>
@endpush
