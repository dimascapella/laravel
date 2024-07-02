<?php

namespace App\Repositories;

use App\Interfaces\RefundRepositoryInterface;
use App\Models\Refund;

class RefundRepository implements RefundRepositoryInterface{
    public function getAllRefund(){
        return Refund::orderBy('id', 'desc')->paginate(5);
    }
    
    public function refundDetail($id){
        $refund = Refund::where('id', $id)->first();

        if(!$refund){
            return 'error_data_not_found';
        }

        return $refund;
    }

    public function createRefund($data){
        $refund = Refund::where('user_id', $data['user_id'])->where('status', false)->first();

        if($refund){
            return 'error_multiple_request';
        }

        return Refund::create($data);
    }

    public function updateRefund($id, $data){
        $refund = Refund::where('id', $id)->first();

        if(!$refund){
            return 'error_data_not_found';
        }

        $refund->method_id = $data['method_id'];
        $refund->amount = $data['amount'];
        $refund->save();
    }

    public function deleteRefund($id){
        return Refund::where('id', $id)->delete();
    }

    public function markDone($id){
        return Refund::where('id', $id)->update([
            'status' => true
        ]);
    }
}