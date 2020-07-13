<?php

    namespace App\Http\Controllers;
    use App\Department;
    use App\User;
    use App\Repository\DepartmentRepositoryInterface;
    use Illuminate\Http\Request;
    use JWTAuth;
    class DepartmentController extends Controller
    {
        protected $user;
        private $departmentRepository;

            public function __construct(DepartmentRepositoryInterface $_departmentRepository)
            {
                $this->user = JWTAuth::parseToken()->authenticate();
                $this->departmentRepository = $_departmentRepository;

            }

            //----------------------------------------------------------------

            public function userdepartment() 
            {
                    return $this->departmentRepository->userdepartment($this->user->departments_id);            
            }

           //----------------------------------------------------------------
       
           public function index()
           {               
                return $this->departmentRepository->all();  
           }

           //----------------------------------------------------------------
          
           public function show($id)
           {
             
               $department = $this->departmentRepository->getDepartmentById($id);
           
               if (!$department) {
                   return response()->json([
                       'success' => false,
                       'message' => 'Sorry, product with id ' . $id . ' cannot be found'
                   ], 400);
               }
           
               return $department;
           }

       //-----------------------------------------------------------------

           public function store(Request $request)
           {             
                    $this->validate($request, [
                    'depName' => 'required',
                    'location' => 'required',
                        ]);

               $department = Department::create($request->all());
           
              return   $this->checker($department, 'Sorry, product could not be added');
              
           }

       //---------------------------------------------------------------

           public function update(Request $request, $id)
           {
               $this->validate($request , [
                   'depName' => 'required',
                   'location' => 'required',
               ]);
               
               $department = $this->departmentRepository->getDepartmentById($id);
           
               if (!$department) {
                   return response()->json([
                       'success' => false,
                       'message' => 'Sorry, Department with id ' . $id . ' cannot be found'
                   ], 400);
               }
           
              $updated = $this->departmentRepository->update($request ,$id);
           
              return  $this->checker($updated, 'Sorry, Department could not be updated');
              
           }

      //----------------------------------------------------------------------

           public function destroy($id)
           {
               $department = $this->departmentRepository->getDepartmentById($id);
           
               if (!$department) {
                   return response()->json([
                       'success' => false,
                       'message' => 'Sorry, product with id ' . $id . ' cannot be found'
                   ], 400);
               }
               $deleted = $department->delete();

              return  $this->checker($deleted , 'Department could not be deleted');

            }
    //---------------------------------------------------------

            private function checker($check  , $message)
            {
                if ($check) {
                    return response()->json([
                        'success' => true
                    ],200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => $message
                    ], 500);
                }
            }
        
    }