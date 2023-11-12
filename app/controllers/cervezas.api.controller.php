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
            if (empty($params)){ //si no hay parametro (algun id), muestra todas.
                $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'ASC';
                $field = isset($_GET['field']) ? strtolower($_GET['field']) : 'id_cerveza';
                $filterBy = isset($_GET['filterBy']) ? strtolower($_GET['filterBy']) : 'null';
                $filterValue = isset($_GET['filterValue']) ? ucfirst($_GET['filterValue']) : 'null';
                $limit = isset($_GET['limit']) ? ($_GET['limit']) : 'null';
                $offset = isset($_GET['offset']) ? ($_GET['offset']) : 'null';
                
                $cervezas = $this->model->getCervezas($order, $field, $filterBy, $filterValue, $limit, $offset);
                $this->view->response($cervezas, 200);    
            /*
            //paginacion
            $page = isset($params[':page']) ? $params[':page'] : 1;
            $perPage = isset($params[':perPage']) ? $params[':perPage'] : 10;

            $parametros['page'] = $page;
            $parametros['perPage'] = $perPage;*/
            }else{
                $cerveza = $this->model->getCerveza($params[':ID']);
                if (!empty($cerveza)){
                    //subrecurso
                    if(isset($params[':subrecurso']) && $params[':subrecurso']){
                        switch ($params[':subrecurso']){
                            case 'nombre':
                                $this->view->response($cerveza->nombre, 200);
                            break;
                            case 'IBU':
                                $this->view->response($cerveza->IBU, 200);
                            break;
                            case 'ALC':
                                $this->view->response($cerveza->ALC, 200);
                            break;
                            case 'stock':
                                $this->view->response($cerveza->stock, 200);
                            break;
                            case 'descripcion':
                                $this->view->response($cerveza->ALC, 200);
                            break;
                            case 'estilo':
                                $this->view->response($cerveza->estilo, 200);
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
                $this->view->response('la cerveza con el id= '.$id.' no existe.', 404);
            }
        }
    }
