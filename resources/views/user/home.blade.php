@extends('ext.header')

@section('content')
    <h1 class="mt-5 text-center">Tambah User</h1>
    <div class="d-flex justify-content-start">
        <a href="{{ route('homepage') }}" class="btn btn-outline-primary">Back</a>
    </div>
    <div class="row mt-3">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('create_user') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Division</label>
                                <select class="form-select" aria-label="Method Type" name="division_id">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md d-flex justify-content-end">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="text-center">List Pengajuan Dana</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ($users->currentPage() - 1)  * $users->perPage() + $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->division->division_name }}</td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="{{ route('edit_user', $user->id) }}" class="btn btn-outline-secondary">Edit</a>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('delete_user', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="6" class="text-center">No Data</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop