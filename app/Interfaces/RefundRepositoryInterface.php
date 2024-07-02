<?php

namespace App\Interfaces;

interface RefundRepositoryInterface{
    public function getAllRefund();
    public function refundDetail($id);
    public function createRefund($data);
    public function updateRefund($id, $data);
    public function deleteRefund($id);
}