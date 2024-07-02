@extends('ext.header')

@section('content')
    <h1 class="mt-5 text-center">Pengajuan Dana</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('user_homepage') }}" class="btn btn-outline-primary">Add User</a>
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
                    <form action="{{ route('create_refund') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">User Name</label>
                                <select class="form-select" aria-label="User Name" name="user_id">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Method Type</label>
                                <select class="form-select" aria-label="Method Type" name="method_id">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($methods as $method)
                                    <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="10000000">
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
                                    <th>Nama Pemohon</th>
                                    <th>Divisi</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($refunds) > 0)
                                    @foreach ($refunds as $refund)
                                        <tr>
                                            <td>{{ ($refunds->currentPage() - 1)  * $refunds->perPage() + $loop->iteration }}</td>
                                            <td>{{ $refund->user->name }}</td>
                                            <td>{{ $refund->user->division->division_name }}</td>
                                            <td>Rp. {{ number_format($refund->amount, 0, ".", ".") }}</td>
                                            <td>{{ $refund->method->method_name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('edit_refund', $refund->id) }}" class="btn btn-outline-secondary">Edit</a>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('delete_refund', $refund->id) }}" method="POST">
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
                            {{ $refunds->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop