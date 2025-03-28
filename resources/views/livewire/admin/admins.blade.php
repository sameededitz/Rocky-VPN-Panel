<div>
    <div class="d-flex justify-content-between mb-2">
        <div>
            <select class="form-select" wire:model.live="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="seach-input">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search..." wire:model.live.500ms="search">
                <span class="input-group-text" id="basic-addon1">
                    <Iconify-icon icon="material-symbols-light:search" width="20" height="20"></Iconify-icon>
                </span>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th wire:click="sortBy('id')" class="cursor-pointer">#
                        <span x-data="{ sortField: @entangle('sortField'), sortDirection: @entangle('sortDirection') }"
                              class="d-inline-flex align-items-center justify-content-center ms-1">
                            <iconify-icon 
                                :icon="sortField === 'id' 
                                    ? (sortDirection === 'asc' 
                                        ? 'iconamoon:arrow-up-2-light' 
                                        : 'iconamoon:arrow-down-2-light') 
                                    : 'fluent:arrow-sort-28-filled'" 
                                width="16" height="16">
                            </iconify-icon>
                        </span>
                    </th>
                    <th wire:click="sortBy('name')" class="cursor-pointer">Name
                        <span x-data="{ sortField: @entangle('sortField'), sortDirection: @entangle('sortDirection') }"
                              class="d-inline-flex align-items-center justify-content-center ms-1">
                            <iconify-icon 
                                :icon="sortField === 'name' 
                                    ? (sortDirection === 'asc' 
                                        ? 'iconamoon:arrow-up-2-light' 
                                        : 'iconamoon:arrow-down-2-light') 
                                    : 'fluent:arrow-sort-28-filled'" 
                                width="16" height="16">
                            </iconify-icon>
                        </span>
                    </th>
                    <th wire:click="sortBy('email')" class="cursor-pointer">Email
                        <span x-data="{ sortField: @entangle('sortField'), sortDirection: @entangle('sortDirection') }"
                              class="d-inline-flex align-items-center justify-content-center ms-1">
                            <iconify-icon 
                                :icon="sortField === 'email' 
                                    ? (sortDirection === 'asc' 
                                        ? 'iconamoon:arrow-up-2-light' 
                                        : 'iconamoon:arrow-down-2-light') 
                                    : 'fluent:arrow-sort-28-filled'" 
                                width="16" height="16">
                            </iconify-icon>
                        </span>
                    </th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th wire:click="sortBy('created_at')" class="cursor-pointer">Joined
                        <span x-data="{ sortField: @entangle('sortField'), sortDirection: @entangle('sortDirection') }"
                              class="d-inline-flex align-items-center justify-content-center ms-1">
                            <iconify-icon 
                                :icon="sortField === 'created_at' 
                                    ? (sortDirection === 'asc' 
                                        ? 'iconamoon:arrow-up-2-light' 
                                        : 'iconamoon:arrow-down-2-light') 
                                    : 'fluent:arrow-sort-28-filled'" 
                                width="16" height="16">
                            </iconify-icon>
                        </span>
                    </th>
                    <th>Action</th>                                                          
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Str::title($user->role) }}</td>
                        <td>{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</td>
                        <td>{{ $user->created_at->toFormattedDateString() }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('user.manage', $user->id) }}"
                                    class="btn btn-light-info btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                    <Iconify-icon icon="ic:round-manage-accounts" width="20"
                                        height="20"></Iconify-icon>
                                </a>
                                <a href="{{ route('admin.edit', $user->id) }}"
                                    class="btn btn-light-success btn-rounded btn-icon me-1 d-inline-flex align-items-center">
                                    <Iconify-icon icon="lucide:edit" width="20" height="20"></Iconify-icon>
                                </a>
                                <button
                                    class="btn btn-light-danger btn-rounded btn-icon d-inline-flex align-items-center"
                                    wire:click="$js.confirmDelete({{ $user->id }})">
                                    <Iconify-icon icon="mingcute:delete-2-line" width="20"
                                        height="20"></Iconify-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Admins found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🌟 Pagination -->
    <div class="mt-2">
        {{ $users->links('components.pagination', data: ['scrollTo' => false]) }}
    </div>
</div>
@script
    <script>
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
                    $wire.deleteUser(id);
                }
            });
        });

        $wire.on('userDeleted', () => {
            Swal.fire({
                title: 'Deleted!',
                text: 'The user has been deleted successfully.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endscript