@section('title', 'Terms of Service and Privacy Policy')

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
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Terms of Service</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">Terms of Service</h4>
                    <p class="text-muted mb-4">Configure your terms of service and privacy policy below:</p>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-alert type="danger" :message="$error" />
                        @endforeach
                    @endif
                    <form class="row g-3" wire:submit.prevent="store">
                        <div class="col-12" wire:ignore>
                            <label class="form-label" for="privacy_policy">Privacy Policy</label>
                            <textarea name="privacy_policy" id="myeditorinstance" wire:model="privacy_policy" class="form-control tinymce-editor"></textarea>
                        </div>
                        <div class="col-12" wire:ignore>
                            <label class="form-label" for="terms_of_service">Terms of Service</label>
                            <textarea id="tosEditor" name="tos" wire:model="tos" class="form-control tinymce-editor"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            skin: 'oxide',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            setup: function(editor) {
                editor.on('blur', function() {
                    let content = editor.getContent();
                    let livewireField = editor.getElement().getAttribute('wire:model');
                    @this.set(livewireField, content);
                });
                editor.on('change', function() {
                    let content = editor.getContent();
                    let livewireField = editor.getElement().getAttribute('wire:model');
                    @this.set(livewireField, content);
                });
            },
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
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/profov2dlbtwaoggjfvbncp77rnjhgyfnl3c2hx3kzpmhif1/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection
