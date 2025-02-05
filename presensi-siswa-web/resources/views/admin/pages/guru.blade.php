@extends('admin.layout.layout')

@section('title', 'Guru')

@section('title-bar', 'Guru')

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Guru</h4>
                    </div>
                    <div class="text-end m-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#Add"
                            class="btn btn-success shadow btn-xs sharp me-1"><i class="fa fa-add"></i></a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <?php $nomer = 1; ?>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $nomer++ }}. {{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="test" class="display min-w850">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Edit{{ $data->id }}"
                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#Delete{{ $data->id }}"
                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- edit -->
                                        <div class="modal fade" id="Edit{{ $data->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="/guru/{{ $data->id }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" value="{{ $data->name }}"
                                                                        name="name" class="form-control"
                                                                        placeholder="Masukkan nama">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" value="{{ $data->username }}"
                                                                        name="username" class="form-control"
                                                                        placeholder="Masukkan username">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" value="{{ $data->email }}"
                                                                        name="email" class="form-control"
                                                                        placeholder="Masukkan email">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" name="password"
                                                                        class="form-control"
                                                                        placeholder="Masukkan password">
                                                                    <small class="text-muted">Kosongkan jika tidak ingin
                                                                        mengubah password</small>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label>Re-Password</label>
                                                                    <input type="password" name="repassword"
                                                                        class="form-control"
                                                                        placeholder="Konfirmasi password">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- delete -->
                                        <div class="modal fade" id="Delete{{ $data->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Anda Yakin Akan Menghapus {{ $data->name }}
                                                        ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger light"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="/guru/{{ $data->id }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- add -->
        <div class="modal fade" id="Add">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="/guru" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Masukkan nama">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Masukkan username">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Masukkan email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Masukkan password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label>Re-Password</label>
                                    <input type="password" name="repassword" class="form-control"
                                        placeholder="Konfirmasi password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#test').DataTable({
            autoWidth: true,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-primary btn-sm',
                    text: 'Column Visibility',
                },
                {
                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm',
                    text: 'Page Length',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
            ],
        });
    </script>
@endsection
