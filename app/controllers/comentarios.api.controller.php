<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/helpers/auth.api.helper.php';
    require_once 'app/models/comentarios.model.php';


    class ComentariosApiController extends ApiController{

        private $model;
        private $authHelper;


        function __construct(){
            parent::__construct();
            $this->model = new ComentariosModel();
            $this->authHelper = new AuthHelper();
        }

        function getComentarios($params = []){
            $input = !empty($_GET["search_input"]) ? $_GET["search_input"] : "";
            $order = (!empty($_GET['order']) && $_GET['order'] == 1) ? "DESC" : "ASC";
    
            $columnas_permitidas = ['id_comentario', 'detalle', 'cerveza'];
            $sorted_by = (!empty($_GET['sort_by']) && in_array($_GET['sort_by'], $columnas_permitidas)) ? $_GET['sort_by'] : "id_cerveza";
    
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $per_page = !empty($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
            $start_index = ($page - 1) * $per_page;
    
            $comentarios = $this->model->getComentarios($input, $order, $per_page, $start_index, $sorted_by);
            return $this->view->response($comentarios, 200);
        }

        function getComentario($params = [])
        {
            $id = $params[":ID"];
    
            if (empty($id)) {
                $this->view->response('No se proporciono un id', 400);
            }
    
            $comentario = $this->model->getComentarioById($id);

            if(!empty($comentario)){
                if(isset($params[':subrecurso']) && $params[':subrecurso']){
                    switch ($params[':subrecurso']){
                        case 'detalle':
                            $this->view->response($comentario->detalle, 200);
                        break;
                        case 'cerveza':
                            $this->view->response($comentario->cerveza, 200);
                        break;
                        default:
                            $this->view->response('El comentario no contiene '.$params[':subrecurso'].'.', 404);
                        break;
                    }
                }else{
                    $this->view->response($comentario, 200);
                }
            }else{
                $this->view->response('El comentario con el id='.$params[':ID'].' no existe.', 404);
            }
        }

        function delete($params = []){
           $user = $this->authHelper->currentUser();
            if(!$user){
                $this->view->response('Unauthorized', 401);
                return;
            }
            
            if($user->role!='ADMIN'){
                $this->view->response('Forbidden', 403);
                return;
            }
            $id_comentario = $params[':ID'];
            if($this->model->getComentarioById($id_comentario)){
                $result = $this->model->deleteComentario($id_comentario);
                if($result > 0){
                    return $this->view->response("El comentario fue eliminado" , 200);
                }else{
                    return $this->view->response("El comentario no se eliminó", 500);
                }
            }else {
                return $this->view->response("El comentario que desea eliminar no existe", 404);
            }
        }

        function create($params = null){
            $body = $this->getData();

            $detalle = $body->detalle;
            $id_cerveza= $body->id_cerveza;

            if (empty($detalle) || empty($id_cerveza)) {
                $this->view->response("Complete los datos correctamente", 400);
            }else{
                $id = $this->model->addComentario($detalle, $id_cerveza);

                //devuelvo el recurso creado.
                $comentario = $this->model->getComentarioById($id);
                $this->view->response(('El comentario se creo existosamente:'));
                $this->view->response($comentario, 201);
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
            $comentario = $this->model->getComentarioById($id);

            if($comentario){
                $body = $this->getData();
                if(isset($body)){
                    $detalle = $body->detalle;
                    $id_cerveza = $body->id_cerveza;
    
                    $this->model->updateComentario($detalle, $id_cerveza, $id);
                    $this->view->response('el comentario con el id = '.$id.' ha sido modificado.', 200);
                }else{
                    $this->view->response('No se modifico el comentario, revise los campos.', 400);
                }
            }else{
                $this->view->response('el comentario con el id = '.$id.' no existe.', 404);
            }
        }
    }