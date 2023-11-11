<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/usuario.model.php';
require_once 'app/models/estilo.model.php';


class EstilosApiController extends ApiController{
    private $model;
    private $authHelper;

    function __construct(){
        parent::__construct();
        $this->model = new EstiloModel();
        $this->authHelper = new AuthHelper();
    }

    function get($params = []){
        /*---------------------FUNCION GET------------------------------*/
        if (empty($params)){
            $estilos = $this->model->getEstilos();
            $this->view->response($estilos, 200);
        }else{
            $estilo = $this->model->getEstilo($params[':ID']);
            if (!empty($estilo)){
                $this->view->response($estilo, 200);
            }else{
                $this->view->response(['msg' => 'El estilo con el id='.$params[':ID'].' no existe.'], 404);
            }
        }
    }

    function create($params = []){
        //valido si esta logueado y si es admin
        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Unauthorized', 401);
            return;
        }
        
        if($user->role!='ADMIN'){
            $this->view->response('Forbidden', 403);
            return;
        }
        /*---------------FUNCION CREATE--------------------------- */
        $body = $this->getData();
        $nombre = $body->nombre;
        if(empty($nombre)){
            $this->view->response("Complete los datos", 400);
        }else{
            $id = $this->model->addEstilo($nombre);
            //devuelvo el recurso creado.
            $estilo = $this->model->getEstilo($id);
            $this->view->response($estilo, 201);
        }
    }

    function delete($params = []){
        //valido si esta logueado y si es admin
        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Unauthorized', 401);
            return;
        }
        
        if($user->role!='ADMIN'){
            $this->view->response('Forbidden', 403);
            return;
        }
        /*---------------FUNCION DELETE--------------------------- */
        $id = $params[':ID'];
        $estilo = $this->model->getEstilo($params[':ID']);

        if($estilo){
            $this->model->deleteEstilo($id);
            $this->view->response('El estilo con el id='.$id.' ha sido borrado.', 200);
        }else{
            $this->view->response('El estilo con el id='.$id.'no existe.', 404);
        }
    }

    function update($params = []){
        //valido si esta logueado y si es admin
        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Unauthorized', 401);
            return;
        }
                
        if($user->role!='ADMIN'){
            $this->view->response('Forbidden', 403);
            return;
        }
        /*---------------FUNCION UPDATE--------------------------- */

        $id = $params[':ID'];
        $estilo = $this->model->getEstilo($params[':ID']);

        if($estilo){
            $body = $this->getData();
            $nombre = $body->nombre;

            $this->model->updateEstilo($nombre, $id);
            $this->view->response('El estilo con el id='.$id.' ha sido modificado.', 200);
        }else{
            $this->view->response('El estilo con el id = '.$id.' no existe.', 404);
        }
    }

}
