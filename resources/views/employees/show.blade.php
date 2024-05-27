@extends('employees.layout')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Employee Information Page</h5>
        </div>
        <div class="card-body">

            <div class="employee-details">
                <h5 class="card-title"><strong>Name: {{ $employee->name }}</strong></h5>
                <p class="card-text"><strong>Username:</strong> {{ $employee->username }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $employee->email }}</p>
                <p class="card-text"><strong>Number of Leaves:</strong> {{ $employee->leave_count }}</p>
                <p class="card-text"><strong>User Type:</strong> {{ $employee->user_type }}</p>

                @if (!empty($employee->salary))
                    <p class="card-text"><strong>Basic Salary:</strong> Rs.{{ $employee->salary }}</p>

                    @php
                        $total_salary = (int) $employee->salary;
                        $deduction = 0;
                        $additional_leaves = 0;
                    @endphp

                    @if ($employee->leave_count > 3)
                        @php
                            $additional_leaves = $employee->leave_count - 3;
                            $deduction = $additional_leaves * 2500;
                            $total_salary -= $deduction;
                            if ($total_salary < 0) {
                                $total_salary = 0;
                            }
                        @endphp

                        <div class="salary-details mt-3">
                            <p class="card-text"><strong>Salary Deduction:</strong> Rs.2500 × ({{ $employee->leave_count }}
                                - 3)
                                =
                                Rs.{{ $deduction }}</p>
                            <p class="card-text"><strong>Total Salary:</strong> Rs.{{ $employee->salary }} -
                                Rs.{{ $deduction }} = Rs.{{ $total_salary }}</p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
