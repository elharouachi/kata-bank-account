<?php
namespace App;

use App\Config;
use eftec\bladeone\BladeOne;

class Controller
{

    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }

    protected function isApiJsonRequest()
    {
        $allHeaders = getallheaders();
        $contentType = $allHeaders['Content-Type'];

        if($contentType == 'application/json')  {
            return true;
        }

        return false;
    }

}
