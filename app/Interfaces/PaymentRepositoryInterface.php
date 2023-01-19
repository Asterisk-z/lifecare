<?php

    namespace App\Interfaces;

    interface PaymentRepositoryInterface 
    {
        public function showBanks($country="NG");
        public function transfer(Array $data);
        public function verifyPayment($id);
        public function pay($data);
        public function verifyAccount(Array $data);
    }
