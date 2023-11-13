<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/usuario.model.php';
require_once 'app/helpers/auth.api.helper.php';

class UserApiController extends ApiController{

    private $model;
    private $authHelper;

    function __construct(){
        parent::__construct();
        $this->authHelper = new AuthHelper();
        $this->model = new UserModel();
    }

    function getToken($params = []){
        $basic = $this->authHelper->getAuthHeaders(); //darnos el header 'Authorization:' 'Basic: base64(usr:pass)'
    
        if(empty($basic)){
            $this->view->response('No envió encabezado de autenticación.', 401);
            return;
        }

        $basic = explode(" ", $basic); //["Basic", "base64(usr:pass)"]

        if($basic[0]!="Basic"){
            $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            return;
        }

        $userpass = base64_decode($basic[1]); //usrpass
        $userpass = explode(":", $userpass); //["usr", "pass"]

        $user = $userpass[0];
        $pass = $userpass[1];

        $usuario = $this->model->getUser($user);

        $usuarioDatos = [ "nombre" => $user];

        if($usuario && password_verify($pass, $usuario->contraseña)){
            // usuario es valido, le retorno un token de accesso
            $token = $this->authHelper->createToken($usuarioDatos);
            $this->view->response($token);
        }else{
            $this->view->response('El usuario o contraseña son incorrectos.', 401);
        }
    }
}