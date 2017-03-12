<?php

class EmployeeController
{

    public function index()
    {
        $employee = new Employee();
        $employees = $employee->all();

        view('index', compact('employees'));

    }

    public function edit(){
        $employee_id = $_GET['id'];

        $em = new Employee();

        $employee = $em->find($employee_id);

//       echo json_encode($em);
        view('edit_employee', compact('employee'));
    }

    public function delete()
    {
        $ids = $_GET['ids'];

        $employee = new Employee();
        $employee->delete($ids);
    }

    public function update()
    {
        $employee = new Employee();
        $employee->update(3, ['firstName' => 'Dav', 'age' => 26]);
    }
}