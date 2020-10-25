<?php

    /**
     * [
     *      App Core Class
     *      Create URL & loads core Controller
     *      URL FORMAT - /controller/method/params
     * ]
    **/
    class Core
    {
        protected $_currentController = 'Pages';
        protected $_currentMethod = 'index';
        protected $_params = [];

        /**
         * [
         *      Calls controller's method with args
         * ]
        **/
        public function __construct()
        {
            $parsedUrl = $this->getUrl();

            // Check if a controller was specified
            if(isset($parsedUrl[0]))
            {
                // Look in controllers for first value
                if(file_exists('../app/Constrollers/' . ucwords($parsedUrl[0]) . '.class.php'))
                {
                    $this->_currentController = ucwords($parsedUrl[0]);
                }

                // Cleanup
                unset($parsedUrl[0]);

            }

            // Require the controllers
            require_once '../app/Controllers/' . $this->_currentController . '.class.php';

            // Instantiate controller class
            $this->_currentController = new $this->_currentController;

            // Check for second param - methods
            if(isset($parsedUrl[1]))
            {
                // Check if method exists in controllers
                if(method_exists($this->_currentController, $parsedUrl[1]))
                {
                    $this->_currentMethod = $parsedUrl[1];
                }

                // Cleanup
                unset($parsedUrl[1]);
            }

            // Get url paramethers
            $this->_params = $parsedUrl ? array_values($parsedUrl) : [];

            // Call a callback with array of _params
            call_user_func_array([
                $this->_currentController,
                $this->_currentMethod
            ], $this->_params);

        }

        /**
         * [
         *      getUrl parse url and explode by /
         * ]
         *
         * @return [array] [parsed url(/controller/methods/args) to an array exploded by /
        **/
        public function getUrl()
        {
            if(isset($_GET['url']))
            {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);

                $url = explode('/', $url);
                return $url;
            }
        }
    };
