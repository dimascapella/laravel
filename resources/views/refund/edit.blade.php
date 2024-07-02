@extends('ext.header')

@section('content')
    <h1 class="mt-5 text-center">Edit Refund Data</h1>
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
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('update_refund', $refund->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Nama Pemohon</label>
                                <input type="text" class="form-control" value="{{ $refund->user->name }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Division</label>
                                <input type="text" class="form-control" value="{{ $refund->user->division->division_name }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Method Type</label>
                                <select class="form-select" aria-label="Method Type" name="method_id">
                                    @foreach ($methods as $method)
                                    <option value="{{ $method->id }}" {{$refund->method_id == $method->id  ? 'selected' : ''}}>{{ $method->method_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="10000000" value="{{ $refund->amount }}">
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
        </div>
    </div>
@stop