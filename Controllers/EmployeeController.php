<?php

class EmployeeController
{

    public function index()
    {
        $employee = new Employee();
        $employees = $employee->all();

        view('index.php', compact('employees'));

    }

    public function delete()
    {
        $ids = json_decode($_GET['ids']);

        $employee = new Employee();
        $employee->delete($ids);
    }

    public function update()
    {
        $employee = new Employee();
        $employee->update(3, ['firstName' => 'Dav', 'age' => 26]);
    }
}