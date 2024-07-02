<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DivisionRepositoryInterface;
use App\Interfaces\MethodRepositoryInterface;
use App\Interfaces\RefundRepositoryInterface;

use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private DivisionRepositoryInterface $divisionRepository;
    private MethodRepositoryInterface $methodRepository;
    private RefundRepositoryInterface $refundRepository;

    public function __construct(UserRepositoryInterface $userRepository, DivisionRepositoryInterface $divisionRepository, MethodRepositoryInterface $methodRepository, RefundRepositoryInterface $refundRepository) 
    {
        $this->userRepository = $userRepository;
        $this->divisionRepository = $divisionRepository;
        $this->methodRepository = $methodRepository;
        $this->refundRepository = $refundRepository;
    }


    /**
     * Refund Controller Logic Start here
     */

    public function homepage(Request $request){
        $refunds = $this->refundRepository->getAllRefund();
        $users = $this->userRepository->getAllUser();
        $methods = $this->methodRepository->getAllMethod();

        return view('main', [
            'refunds' => $refunds,
            'users' => $users,
            'methods' => $methods
        ]);
    }

    public function postRefund(Request $request){
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'user_id' => 'required',
            'method_id' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'amount' => $request->input('amount'),
            'user_id' => $request->input('user_id'),
            'method_id' => $request->input('method_id'),
        ];

        $this->refundRepository->createRefund($data);

        return back()->with('message', 'Data Refund Created!');
    }

    public function deleteRefund(Request $request, $id){
        $this->refundRepository->deleteRefund($id);

        return back()->with('message', 'Refund Data Deleted!');
    }

    public function editRefund(Request $request, $id){
        $refund = $this->refundRepository->refundDetail($id);
        $methods = $this->methodRepository->getAllMethod();

        return view('refund.edit', [
            'refund' => $refund,
            'methods' => $methods
        ]);
    }

    public function updateRefund(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'method_id' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'amount' => $request->input('amount'),
            'method_id' => $request->input('method_id'),
        ];

        $this->refundRepository->updateRefund($id, $data);

        return redirect()->route('homepage')->with('message', 'Refund Data Updated!');
    }

    /**
     * Refund Controller Logic End Here
     */

    /**
     * User Controller Logic Start here
     */

    public function userHomepage(Request $request){
        $divisions = $this->divisionRepository->getAllDivision();
        $users = $this->userRepository->getAllUser();

        return view('user.home', [
            'divisions' => $divisions,
            'users' => $users
        ]);
    }

    public function postUser(Request $request){
        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'name' => 'required|unique:users|min:8',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'division_id' => $request->input('division_id'),
        ];

        $this->userRepository->createUser($data);

        return back()->with('message', 'Data User Created!');
    }

    public function deleteUser(Request $request, $id){
        $this->userRepository->delete($id);

        return back()->with('message', 'User Data Deleted!');
    }

    public function editUser(Request $request, $id){
        $user = $this->userRepository->findById($id);

        $divisions = $this->divisionRepository->getAllDivision();

        return view('user.edit', [
            'user' => $user,
            'divisions' => $divisions,
        ]);
    }

    public function updateUser(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'name' => 'required|min:8',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'division_id' => $request->input('division_id'),
        ];

        $user = $this->userRepository->updateRefund($id, $data);

        if($user == 'error_data_not_found'){
            return back()->with('error', 'User Not Found');
        }

        return redirect()->route('user_homepage')->with('message', 'User Data Updated!');
    }
    
    /**
     * User Controller Logic End Here
     */
}
