<?php
class ApiRoute extends CakeRoute {
 
    function parse($url) {
		//var_dump(preg_filter('/.\?/', $url));
		//$urlComponents = preg_split('/\?/', $url);
		var_dump($url);
		$urlComponents = explode('?', $url);
		var_dump($urlComponents);
		if (!empty($_GET['a'])) {
			
		}
        $params = parent::parse($url);
		
		var_dump($params);
        if (empty($params)) {
            return false;
        }
		
        if ($count) {
            return $params;
        }
        return false;
    }
 
}