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

        function get($params = []){
            $parametros = [];

            if (isset($_GET['sort'])){
                $parametros['sort'] = $_GET['sort'];
            }

            if (isset($_GET['order'])){
                $parametros['order'] = $_GET['order'];
            }
            if (empty($params)){ //si no hay parametro (algun id), muestra todos los comentarios.
                $comentarios = $this->model->getComentarios($parametros);
                $this->view->response($comentarios, 200);
            }
            else{
                $comentario = $this->model->getComentario($params[':ID']);
                if (!empty($comentario)){
                    //subrecurso
                    if(isset($params[':subrecurso']) && $params[':subrecurso']){
                        switch ($params[':subrecurso']){
                            case 'detalle':
                                $this->view->response($comentario->detalle, 200);
                            break;
                            case 'cerveza';
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
            if($this->model->getComentario($id_comentario)){
                $result = $this->model->deleteComentario($id_comentario);
                if($result > 0){
                    return $this->view->response("El comentario fue eliminado" , 200);
                }else{
                    return $this->view->response("El comentario no se eliminó", 404);
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
                $comentario = $this->model->getComentario($id);
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
            $comentario = $this->model->getComentario($id);

            if($comentario){
                $body = $this->getData();
                $detalle = $body->detalle;
                $id_cerveza = $body->id_cerveza;

                $this->model->updateComentario($detalle, $id_cerveza, $id);
                $this->view->response('el comentario con el id = '.$id.' ha sido modificado.', 200);
            }else{
                $this->view->response('el comentario con el id = '.$id.' no existe.', 404);
            }
        }
    }