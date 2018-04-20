<?php

    /**
     * @details Realizando os require once nos arquivos
     */
    require_once "../Control/Controller/Usuario.class.php";

    /**
     * @details Headers de CORS
     */
    header("HTTP/1.1");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

    /**
     * Definindo o time da localização
     */
    date_default_timezone_set('America/Sao_Paulo');

    /**
     * Controle de request
     */
    try{
        //recuperando o metodo de request
        $httpMtd = $_SERVER["REQUEST_METHOD"];

        $user = new Usuarios();
        switch ($httpMtd){

            case "GET":
                if(key_exists("id",$_GET))
                    echo json_encode(
                        [
                            "result"=>$user->read($_GET["id"])
                        ]
                    );
                else
                    echo json_encode(
                        [
                            "result"=>$user->read()
                        ]
                    );
                break;

            case "POST":
                // recuperando o json enviado por post
                $post = json_decode(
                    file_get_contents("php://input")
                );
                echo json_encode(
                    $user->create($post)
                );
                break;
            case "PUT":

                // recuperando o json enviado por put
                $put = json_decode(
                    file_get_contents("php://input")
                );
                if(key_exists("id",$_GET))
                    echo json_encode(
                        $user->update($put, $_GET["id"])
                    );
                else
                    throw new Exception("Bad request",400);

                break;
            case "DELETE":

                if(key_exists("id",$_GET))
                    echo json_encode(
                        [
                            "result"=>$user->delete($_GET["id"])
                        ]
                    );
                else
                    throw new Exception("Bad request",400);

                break;
            default:
                throw new Exception("Method not found",400);
        }
    }catch (\Exception $e){
        http_response_code($e->getCode());
        echo json_encode(
            [
                "msg"=>$e->getMessage(),
                "code"=>$e->getCode()
            ]
        );
    }