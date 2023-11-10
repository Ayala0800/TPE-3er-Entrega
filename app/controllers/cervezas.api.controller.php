<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/helpers/auth.api.helper.php';
    require_once 'app/models/beer.model.php';

    class CervezasApiController extends ApiController{
        private $model;
        private $authHelper;

        function __construct(){
            parent::__construct();
            $this->model = new BeerModel();
            $this->authHelper = new AuthHelper();
        }

        function get($params = []){

            $user = $this->authHelper->currentUser();
            if(!$user){
                $this->view->response('Unauthorized', 401);
                return;
            }
            
            if($user->role!='ADMIN'){
                $this->view->response('Forbidden', 403);
                return;
            }
            /*---------------------FUNCION GET------------------------------*/
            if (empty($params)){
                /* filtrar
                $filterPending = false;
                if(isset($_GET['pending'])){
                    $filterPending = $_GET['pending'] == 'true';
                }
                */

                $cervezas = $this->model->getCervezas();
                $this->view->response($cervezas, 200);
            }else{
                $cerveza = $this->model->getCerveza($params[':ID']);
                if (!empty($cerveza)){
                    //subrecurso
                    if($params[':subrecurso']){
                        switch ($params[':subrecurso']){
                            case 'nombre':
                                $this->view->response($cerveza->nombre, 200);
                            break;
                            case 'ALC':
                                $this->view->response($cerveza->ALC, 200);
                            break;
                            default:
                                $this->view->response('La cerveza no contiene '.$params[':subrecurso'].'.', 404);
                            break;
                        }
                    }else{
                        $this->view->response($cerveza, 200);
                    }
                }else{
                    $this->view->response('La cerveza con el id='.$params[':ID'].' no existe.', 404);
                }
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
            $cerveza = $this->model->getCerveza($params[':ID']);

            if($cerveza){
                $this->model->deleteCervezaFromDB($id);
                $this->view->response('la cerveza con el id='.$id.' ha sido borrada.', 200);
            }else{
                $this->view->response('la cerveza con el id='.$id.'no existe.', 404);
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
            $ibu = $body->IBU;
            $alc = $body->ALC;
            $id_estilo = $body->id_estilo;
            $stock = $body->stock;
            $descripcion = $body->descripcion;

            if (empty($nombre) || empty($ibu) || empty($alc) || empty($id_estilo) || empty($stock) || empty($descripcion) ) {
                $this->view->response("Complete los datos", 400);
            }else{
                $id = $this->model->addCervezaToDB($nombre, $ibu, $alc, $id_estilo, $stock, $descripcion);

                //devuelvo el recurso creado.
                $cerveza = $this->model->getCerveza($id);
                $this->view->response($cerveza, 201);
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
            $cerveza = $this->model->getCerveza($params[':ID']);

            if($cerveza){
                $body = $this->getData();
                $nombre = $body->nombre;
                $ibu = $body->IBU;
                $alc = $body->ALC;
                $id_estilo = $body->id_estilo;
                $stock = $body->stock;
                $descripcion = $body->descripcion;

                $this->model->updateCerveza($nombre, $ibu, $alc, $id_estilo, $stock, $descripcion, $id);
                $this->view->response('la cerveza con el id='.$id.' ha sido modificada.', 200);
            }else{
                $this->view->response('la cerveza con el id='.$id.'no existe.', 404);
            }
        }
    }