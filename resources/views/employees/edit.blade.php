@extends('employees.layout')
@section('content')

    <div class="card">
        <div class="card-header">Edit Employee Data Page</div>
        <div class="card-body">

            <form action="{{ route('employees.update', $employee->id) }}" method="post">
                {!! csrf_field() !!}
                @method('PATCH')

                <input type="hidden" name="id" value="{{ $employee->id }}">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control">
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" value="{{ $employee->username }}"
                        class="form-control">
                    @error('username')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ $employee->email }}" class="form-control">
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user_type" class="form-label">User Type</label>
                    <select name="user_type" id="user_type" class="form-control">
                        <option value="employee" {{ $employee->user_type == 'employee' ? 'selected' : '' }}>Employee
                        </option>
                        <option value="admin" {{ $employee->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('user_type')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" name="salary" id="salary" value="{{ $employee->salary }}"
                        class="form-control">
                    @error('salary')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" value="Update" class="btn btn-success mt-3">
            </form>

        </div>
    </div>

@stop
