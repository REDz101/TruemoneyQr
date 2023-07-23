<?php

    class TruewalletQr {

        public function __construct() { }
    
        public function qrcode($phone, $amount) {
        $this->amount = number_format($amount, 2);
        $this->id = $phone;
    
            $data =  '000201';
            $data .= '010212';
            
            $merchantInfo =  '0016A000000677010111'; // application ID
            
            $merchantInfo .= '03';
            if (strlen($this->id) == 10) {
                $merchantInfo .= '1514000' . substr($this->id, -10);
            } else {
                return false;
            }
            
            $data .= '5303764';
            if ($this->amount > 0) {
                $amountText = number_format($this->amount, 2, '.', '');
                $amountLen = strlen($amountText);
                $data .= '54' . ($amountLen < 10 ? '0' . $amountLen : $amountLen) . $amountText;
            }
            $data .= '29' . strlen($merchantInfo) . $merchantInfo;
            $data .= '5802TH';
            
            $data .= '6304';
            $sum = strtoupper(dechex($this->crc16($data)));
            $data .= $sum;
    
            return $data;
        }
    
        public function crc16($data) {
            $crc = 0xFFFF;
            for ($i = 0; $i < strlen($data); $i++) {
                $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
                $x ^= $x >> 4;
                $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
            }
            return $crc;
        }

    }