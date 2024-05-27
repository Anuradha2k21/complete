@extends('employees.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center d-flex justify-content-between align-items-center">
                        <h2>Employee Information</h2>
                        <a href="http://127.0.0.1:8000/chatify" class="btn btn-primary">
                            Chat <i class="fas fa-comments" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-start w-100">
                                <a href="{{ url('/employees/create') }}" class="btn btn-success btn-lg"
                                    title="Add New Employee">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                                <div class="col-md-6">
                                    @if (session('flash_message') == 'Employee Added!' || session('flash_message') == 'Employee Updated!')
                                        <div id="flashMessage" class="alert alert-success justify-content-center"
                                            style="padding: 10px; border-radius: 5px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; width: fit-content;">
                                            {{ session('flash_message') }}
                                        </div>
                                        <script>
                                            setTimeout(function() {
                                                document.getElementById('flashMessage').style.display = 'none';
                                            }, 2500);
                                        </script>
                                    @elseif (session('flash_message') == 'Employee Deleted!')
                                        <div id="flashMessage" class="alert alert-danger justify-content-center"
                                            style="padding: 10px; border-radius: 5px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; width: fit-content;">
                                            {{ session('flash_message') }}
                                        </div>
                                        <script>
                                            setTimeout(function() {
                                                document.getElementById('flashMessage').style.display = 'none';
                                            }, 2500);
                                        </script>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="btn btn-danger">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br /><br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Salary</th>
                                        <th>Leave Count</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->salary }}</td>
                                            <td class="{{ $item->leave_count > 3 ? 'fs-4 text-danger fw-bold' : '' }}">
                                                {{ $item->leave_count }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ url('/employees/' . $item->id) }}" title="View Employee"
                                                        class="btn btn-info mx-1">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                    </a>
                                                    <a href="{{ url('/employees/' . $item->id . '/edit') }}"
                                                        title="Edit Employee" class="btn btn-primary mx-1">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </a>
                                                    <form method="POST" action="{{ url('/employees' . '/' . $item->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger mx-1"
                                                            title="Delete Employee"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
