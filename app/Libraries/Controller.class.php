<?php
    /**
     * [
     *      Base controller
     *      Loads models and view
     * ]
    **/
    class Controller
    {

        /**
         * [
         *      Instantiete models
         * ]
         *
         * @param  [model name] $model [find model in models folders]
         * @return [model object] [return a instancieted model class]
        **/
        public function model($model)
        {
            try
            {
                // Check if we can open file
                if (!@include_once('../app/Models/' . $model . '.class.php'))
                    throw new Exception ($model . '.class.php could not be imported');

                // Check if file exists
                if (!file_exists('../app/Models/' . $model . '.class.php'))
                {
                    throw new Exception ($model . '.class.php does not exist');
                }
                else
                {
                    // Require and return an instance
                    require_once('../app/Models/' . $model . '.class.php');

                    // Return a new model instance
                    return new $model();
                }
            }
            catch(Exception $e)
            {
                echo "Message : " . $e->getMessage() . "\n";
                echo "Code : " . $e->getCode() . "\n";
            }
        }

        /**
         * [
         *      View function to load views
         * ]
         *
         * @param  [name] $view [view name to be loaded]
         * @param  array  $data [data to be passed to view]
         * @return [type]       [no return]
        **/
        public function view($view, $data = [])
        {
            try
            {
                // Check if we can import file
                if(!@include_once('../app/Views/' . $view . '.php'))
                    throw new \Exception("Can't import view file: " . $view);

                // Check if file exists
                if(!file_exists('../app/Views/' . $view . '.php'))
                {
                    throw new \Exception($view . ".php file doesn't not exist");
                }
                else
                {
                    // Initiate view
                    require_once '../app/Views/' . $view . '.php';
                }

            }
            catch (\Exception $e)
            {
                echo "Message : " . $e->getMessage() . "\n";
                echo "Code : " . $e->getCode() . "\n";
            }
        }
    }
