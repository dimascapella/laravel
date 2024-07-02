@extends('ext.header')

@section('content')
    <h1 class="mt-5 text-center">Edit User</h1>
    <div class="d-flex justify-content-start">
        <a href="{{ route('user_homepage') }}" class="btn btn-outline-primary">Back</a>
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
                    <form action="{{ route('update_user', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe" value="{{ $user->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Division</label>
                                <select class="form-select" aria-label="Method Type" name="division_id">
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{$user->division_id == $division->id  ? 'selected' : ''}}>{{ $division->division_name }}</option>
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
        </div>
    </div>
@stop