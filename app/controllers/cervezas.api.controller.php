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

        function getCervezas($params = [])
        {
            $input = !empty($_GET["search_input"]) ? $_GET["search_input"] : "";
            $order = (!empty($_GET['order']) && $_GET['order'] == 1) ? "DESC" : "ASC";
    
            $columnas_permitidas = ['id_cerveza', 'nombre', 'IBU', 'ALC', 'id_estilo', 'stock', 'descripcion'];
            $sorted_by = (!empty($_GET['sort_by']) && in_array($_GET['sort_by'], $columnas_permitidas)) ? $_GET['sort_by'] : "id_cerveza";
    
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $per_page = !empty($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
            $start_index = ($page - 1) * $per_page;
    
            $cervezas = $this->model->getCervezas($input, $order, $per_page, $start_index, $sorted_by);
            return $this->view->response($cervezas, 200);
        }
    
        function getCerveza($params = [])
        {
            $id = $params[":ID"];
    
            if (empty($id)) {
                $this->view->response('No se proporciono un id', 400);
            }
    
            $cerveza = $this->model->getCervezaById($id);

            if(!empty($cerveza)){
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
                            $this->view->response($cerveza->descripcion, 200);
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
            $cerveza = $this->model->getCervezaById($params[':ID']);

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
                $cerveza = $this->model->getCervezaById($id);
                $this->view->response(('La cerveza se creo existosamente:'));
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
            $cerveza = $this->model->getCervezaById($params[':ID']);


            if($cerveza){
                $body = $this->getData();

                if(isset($body)){
                    $nombre = $body->nombre;
                    $ibu = $body->IBU;
                    $alc = $body->ALC;
                    $id_estilo = $body->id_estilo;
                    $stock = $body->stock;
                    $descripcion = $body->descripcion;

                    $this->model->updateCerveza($nombre, $ibu, $alc, $id_estilo, $stock, $descripcion, $id);
                    $this->view->response('la cerveza con el id='.$id.' ha sido modificada.', 200);
                }else{
                    $this->view->response('No se modifico la cerveza, revise los campos.', 400);
                }
            }else{
                $this->view->response('la cerveza con el id= '.$id.' no existe.', 404);
            }
        }
    }