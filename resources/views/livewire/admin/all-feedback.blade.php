@section('title', 'All Feedback')

@section('styles')
    <link href="{{ asset('src/assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
<div>
    <div class="page-meta">
        <div class="breadcrumb-wrapper-content d-flex justify-content-end">
            <nav class="breadcrumb-style-three">
                <ol class="breadcrumb align-items-center">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <iconify-icon icon="stash:home-duotone" width="24" height="24"></iconify-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">FeedBacks</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-12 layout-spacing">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">All FeedBacks</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <select class="form-select form-select-sm" wire:model.live="perPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="search-input">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live.500ms="search">
                                <span class="input-group-text">
                                    <iconify-icon icon="material-symbols-light:search" width="20"
                                        height="20"></iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                    <th>Rating</th>
                                    <th>Sent At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($feedbacks as $feedback)
                                    <tr>
                                        <td>{{ $feedback->id }}</td>
                                        <td>{{ $feedback->subject }}</td>
                                        <td>{{ $feedback->email }}</td>
                                        <td>{{ $feedback->rating }}</td>
                                        <td>{{ $feedback->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-light-info btn-rounded btn-icon d-inline-flex align-items-center me-2"
                                                    wire:click="viewFeedback({{ $feedback->id }})">
                                                    <iconify-icon icon="lsicon:view-outline" width="20"
                                                        height="20"></iconify-icon>
                                                </button>
                                                <button
                                                    class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                                    wire:click="$js.confirmDelete({{ $feedback->id }})">
                                                    <iconify-icon icon="mingcute:delete-2-line" width="20"
                                                        height="20"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No FeedBacks found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        {{ $feedbacks->links('components.pagination', data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewFeedbackModal" wire:ignore.self tabindex="-1" role="dialog"
        aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="inputFormModalLabel">
                    <h5 class="modal-title">View FeedBack For <b>{{ $subject ?? 'N/A' }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">
                        <Iconify-icon icon="bi:x-lg" width="20" height="20"></Iconify-icon>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{ $message ?? 'No FeedBack found' }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger mt-2 mb-2 btn-no-effect"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('viewFeedback', () => {
            let modalElement = document.getElementById('viewFeedbackModal');
            let myModal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            myModal.show();
        });

        $js('confirmDelete', (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteFeedback(id);
                }
            });
        });

        $wire.on('sweetAlert', (event) => {
            Swal.fire({
                title: event.title,
                text: event.message,
                icon: event.type,
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endscript
