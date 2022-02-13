<?php

namespace App\Controller\Web;

use App\Controller;
use App\model\BankAccount;
use App\Response;
use App\Session;

class OperationsController extends Controller
{

    public function withdraw()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST' && $this->isApiJsonRequest()) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            if(isset($_POST['amount']) && (float) $_POST['amount'] < 0)
            {
                Response::send(["error" => true, 'message' => 'KOIIII', 'code' => 400]);
            }
            if(isset($_POST['user']) && (int) $_POST['user'] < 0)
            {
                Response::send(["error" => true, 'message' => 'KO000', 'code' => 400]);
            }

            $bankAccount = new BankAccount($_POST['user']);

            if($bankAccount->getBalanceValue() > 0 && $bankAccount->getBalanceValue() >= $_POST['amount'])
            {
                $bankAccount->withdraw($_POST['amount'], new \DateTime('now'), $_POST['title'] ?? 'transaction withdraw');
            }
            else
            {
                Response::send(["error" => true, 'message' => 'KOeee', 'code' => 400]);
                return;
            }

        }
        Response::send(["error" => false, 'message' => 'OK', 'code' => 200]);
        return;    }

    public function deposit()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST' && $this->isApiJsonRequest()) {
          $_POST = json_decode(file_get_contents('php://input'), true);
            if(isset($_POST['amount']) && (float) $_POST['amount'] < 0)
            {
                Response::send(["error" => true, 'message' => 'KO', 'code' => 400]);
            }
              if(isset($_POST['user']) && (int) $_POST['user'] < 0)
              {
                  Response::send(["error" => true, 'message' => 'KO', 'code' => 400]);
              }

              $bankAccount = new BankAccount($_POST['user']);
              $bankAccount->deposit($_POST['amount'], new \DateTime('now'), $_POST['title'] ?? 'transaction deposit');
        }
        Response::send(["error" => false, 'message' => 'OK', 'code' => 200]);
    }

    public function statement()
    {
        Response::send(["oxoox" => 'ddd']);
    }


}
