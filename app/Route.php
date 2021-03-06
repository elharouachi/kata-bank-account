<?php
namespace App;

class Route
{

    public static function __callStatic($nameOfFunction, $arguments)
    {

        if($nameOfFunction == 'get') @self::_get($arguments[0], $arguments[1]);
        else if($nameOfFunction == 'post') @self::_post($arguments[0], $arguments[1]);
      //   else if($nameOfFunction == 'put') @self::_put($arguments[0], $arguments[1]);
      //   else if($nameOfFunction == 'delete') @self::_delete($arguments[0], $arguments[1]);
    }

    static function parse_url()
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        $request_uri = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
        return self::parse_args($request_uri);
    }

    static function parse_args($request_uri)
    {
        $_args = NULL;

        if(isset($request_uri) && !empty($request_uri)){
            if(strstr($request_uri, "?")){
                $explode_request_uri = explode("?", $request_uri);
                $request_uri = $explode_request_uri[0];

                $args = explode("&", $explode_request_uri[1]);
                for ($i=0; $i < count($args); $i++) {
                    $expArgs = explode("=", $args[$i]);
                    if(isset($expArgs[0]) && isset($expArgs[1])){
                        $_args[$expArgs[0]] = $expArgs[1];
                    }
                }
            }
        }
        return [
            "url" => $request_uri,
            "args" => $_args
        ];
    }

    static function _get($url, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            return self::run($url, $callback);
    }

    static function _post($url, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            return self::run($url, $callback);
    }

    static function _put($url, $callback)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'PUT')
        {
            return self::run($url, $callback);
        }
    }

    static function _delete($url, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
            return self::run($url, $callback);
    }


    static function run($url, $callback)
    {
        $patterns = [
            '{url}' => '([0-9a-zA-Z-_]+)',
            '{id}' => '([0-9]+)'
        ];

        $url = str_replace(array_keys($patterns), array_values($patterns), $url);

        $request_uri = self::parse_url();
        if (preg_match('@^' . $url . '$@', $request_uri['url'], $parameters)) {
            unset($parameters[0]);

            if($request_uri['args'] !== NULL) $parameters = array_merge($parameters, $request_uri['args']);

            if (is_callable($callback)) {
                call_user_func_array($callback, $parameters);
            } else {
                $controller = explode('@', $callback);
                $classname = 'App\Controller\\' . $controller[0];
                call_user_func_array([new $classname, $controller[1]], $parameters);
            }
            exit;

        }
    }
}
