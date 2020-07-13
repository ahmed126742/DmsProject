<?php

namespace App\Repository;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function userdepartment($department_id)
    {

        return  Department::where('id',$department_id)
                ->get(['id','depName','location'])
                ->map(function ($department)
                  {
                        return [
                        'Department_Id' => $department->id,
                        'Department_Name' => $department->depName,
                        'Department_location' => $department->location
                                ];
                   });
    }

    //-------------------------------------------------

    public function all()
    {
        return Department::get(['id','depName','location'])
                ->map(function ($department)
                    {
                        return [
                        'Department_Id' => $department->id,
                        'Department_Name' => $department->depName,
                        'Department_location' => $department->location
                        ];
                    });
    }

    //--------------------------------------------------

    public function getDepartmentById($id)
    {
        return Department::find($id);
    }

    //------------------------------------------------------------
    public function update($request,$id)
    {
       return  Department::where('id',$id)->update([
                'depName'=> $request->depName,
                'location' => $request->location
                ]);
    }

}
