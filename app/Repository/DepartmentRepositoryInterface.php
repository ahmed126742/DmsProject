<?php

namespace App\Repository;

interface DepartmentRepositoryInterface
{

    public function userdepartment($department_id);

    public function all();

    public function getDepartmentById($id);

    public function update($request,$id);

}
