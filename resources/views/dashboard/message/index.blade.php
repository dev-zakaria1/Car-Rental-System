<x-admin-layout>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="index.html">
                <span class="align-middle">AdminKit</span>
            </a>

            @include('dashboard.layouts.sidebar')
            <x-dropdown-link />
        </div>
    </nav>
    <div class="main">
        @include('dashboard.layouts.navigation')
        <div class="d-flex flex-column justify-content-between" style="min-height: 100vh">
            <div>
                @include('dashboard.layouts.alert')
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Contact Messages</h5>

                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th class="d-none d-xl-table-cell">Message</th>
                            <th>is_read</th>
                            @can('delete', App\Models\message::class)
                                <th class="d-none d-xl-table-cell">delete</th>
                            @endcan
                            <th class="d-none d-md-table-cell">Joined At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contact_messages as $contact_message)
                            <tr>
                                <td>
                                    <strong>{{ $contact_message->first_name }}</strong><br>
                                    <small class="text-muted">ID: #{{ $contact_message->id }}</small>
                                </td>
                                <td class="d-none d-xl-table-cell">{{ $contact_message->last_name }}</td>
                                <td class="d-none d-md-table-cell">{{ $contact_message->email }}</td>
                                <td class="d-none d-md-table-cell">{{ $contact_message->message }}</td>
                                <td class="d-none d-xl-table-cell">
                                    <form action="{{ route('message.update', $contact_message->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="is_read" onchange="this.form.submit()"
                                            class="form-select form-select-sm border-0 fw-bold"
                                            style="background: transparent; cursor: pointer;">
                                            <option value="1"
                                                {{ $contact_message->is_read == 1 ? 'selected' : '' }}>
                                                read
                                            </option>
                                            <option value="0"
                                                {{ $contact_message->is_read == 0 ? 'selected' : '' }}>
                                                UnRead
                                            </option>
                                        </select>
                                        <input type="hidden" name="is_active"
                                            value="{{ $contact_message->is_active }}">
                                    </form>
                                </td>
                                @can('delete', $contact_message)
                                    <td class="d-none d-md-table-cell">
                                        <form action="{{ route('message.delete', $contact_message->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">delete</button>
                                        </form>
                                    </td>
                                @endcan

                                <td class="d-none d-md-table-cell">
                                    {{ $contact_message->created_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="custom-pagination">
                            {{ $contact_messages->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('dashboard.layouts.footer')
    </div>
    </div>

</x-admin-layout>
