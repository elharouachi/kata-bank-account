<?php
namespace App\model;
use App\Model;

class Transaction extends Model
{
    private $amount;
    private \DateTime $date;
    private $balance;
    private $title;


    public function __construct($amount, $date, $balance, $title = '')
    {
        $this->amount = $amount;
        $this->date = $date;
        $this->title = $title;
        $this->balance = $balance;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getDate(): string
    {
        return $this->date->format('YmdHis');
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }
}
