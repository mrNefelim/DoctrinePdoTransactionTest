<?php

namespace DoctrinePdoTransactionTest;

class Generator
{
    /**
     * @param int $length
     * @return string
     */
    public function behave(int $length = 10000): string
    {
        $string = date('Y-m-d H:i:s')."abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return str_pad('', $length, $string);
    }
}