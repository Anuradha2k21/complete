<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'email' => 'required|email|unique:employees,email',
                'username' => 'required|string|unique:employees,username',
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'salary' => 'nullable|numeric',
            ]);

            // Hash the password
            $validated['password'] = bcrypt($validated['password']);

            // Set additional attributes
            $validated['leave_count'] = rand(2, 5);

            // Create the employee
            $employee = Employee::create($validated);

            // Check if the employee creation was successful
            if ($employee) {
                return redirect('employees')->with('flash_message', 'Employee Added!');
            } else {
                return redirect('employees')->with('flash_message', 'Failed to add employee!');
            }
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error adding employee: ' . $e->getMessage());
            return redirect()->back()
                ->with('flash_message', 'An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function show(string $id): View
    {
        $employee = Employee::find($id);
        return view('employees.show')->with('employee', $employee);
    }

    public function edit(string $id): View
    {
        $employee = Employee::find($id);
        return view('employees.edit')->with('employee', $employee);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            // Find the employee by ID
            $employee = Employee::findOrFail($id);

            // Validate the incoming request data
            $validated = $request->validate([
                'email' => 'required|email|unique:employees,email,' . $id,
                'username' => 'required|string|unique:employees,username,' . $id,
                'name' => 'required|string|max:255',
                'salary' => 'nullable|numeric',
                // Add validation rules for other fields (password, etc.)
            ]);

            // Update the employee with validated data
            $employee->update($validated);

            return redirect('employees')->with('flash_message', 'Employee Updated!');
        } catch (ValidationException $e) {
            Log::error('Validation error updating employee: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->back()
                ->with('flash_message', 'An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }



    public function destroy(string $id): RedirectResponse
    {
        Employee::destroy($id);
        return redirect('employees')->with('flash_message', 'Employee Deleted!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

