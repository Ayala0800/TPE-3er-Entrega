<?php

    class ApiView{
        public function response($data, $status = 200){
            header('Content-type: application/json');
            header('HTTP/1.1 '.$status.''.$this->_requestStatus($status));
            echo json_encode($data);
        }

        private function _requestStatus($code){
            $status = array(
                200 => "OK",
<<<<<<< HEAD
                201 => "Created",
=======
                200 => "Created",
                400 => "Bad Request",
>>>>>>> rama01
                404 => "Not Found",
                500 => "Internal server error",
            );
            return (isset($status[$code])) ? $status[$code]:$status[500];
        }
    }
