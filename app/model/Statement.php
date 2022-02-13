<?php
namespace App\model;
use App\Model;

class Statement extends Model
{
    /**
     * @var Transaction[]
     */
    public array $operations;

    /**
     * @return Transaction[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @param Transaction[] $operations
     */
    public function setOperations(array $operations): void
    {
        $this->operations = $operations;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }
    public float $balance;
}
