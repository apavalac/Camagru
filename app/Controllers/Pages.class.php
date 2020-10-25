<?php

    class Pages extends Controller
    {
        public function __construct()
        {

        }

        public function index()
        {
            $this->view('index');
        }

        public function about()
        {
            echo "about page "."\n";
        }
    }
