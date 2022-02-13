<?php
namespace App\model;
use DateTime;

interface BankAccountInterface
{
    public function deposit(float $amount, DateTime $date, $title): void;

    public function withdraw(float $amount, DateTime $date, $title): void;

    public function statement();
}
