<?php
namespace App\model;



class BankAccount  implements BankAccountInterface
{
    private $balance;
    private $history;
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->balance = new Amount($_SESSION['user_'.$userId]['amount'] ?? 0);
        $this->history = new History($_SESSION['user_'.$userId]['history'] ?? []);
    }

    public function deposit(float $amount, \DateTime $date, $title): void
    {
        $depositAmount = new Amount($amount);
        $this->applyTransaction($depositAmount);
        $this->registerTransactionInHistory($depositAmount, $date, $title);
    }

    public function withdraw(float $amount, \DateTime $date, $title): void
    {
        $depositAmount = new Amount($amount*(-1));
        $this->applyTransaction($depositAmount);
        $this->registerTransactionInHistory($depositAmount, $date, $title);
    }

    public function statement()
    {
        // TODO: Implement statement() method.
    }

    private function applyTransaction(Amount $amount)
    {
        $this->balance = $this->balance->add($amount);
        $_SESSION['user_'.$this->userId]['amount'] = $this->balance->getValue();
    }


    private function registerTransactionInHistory(Amount $amount,  $date, $title)
    {
        $transaction = new Transaction($amount, $date, $this->balance, $title);
        $this->history->appendTransaction($transaction);
        $_SESSION['user_'.$this->userId]['history'] = $this->history->getTransactionList();

    }

    public function getBalanceValue(): int
    {
        return $this->balance->getValue();
    }
}

