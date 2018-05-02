<?php

require_once __DIR__."/../../Database/Connection.class.php";
require_once __DIR__."/../Interfaces/InterfaceCRUD.interface.php";
require_once __DIR__."/../Model/Usuarios.class.php";

/**
 * Os namespaces apelidos para os arquivos, para não ocorrer o erro de nomes duplicados
 */
use CRUD\Control\Interfaces\InterfaceCRUD;
use CRUD\Control\Model\Usuarios as User;

class Usuarios implements InterfaceCRUD
{
    private $user;
    public function __construct()
    {

    }

    /**
     * @param $post
     * @return array|mixed
     * @throws Exception
     */
    public function create($post)
    {
        try{
            $this->user = new User($post->nome,$post->senha,$post->email);

            //TODO:: Deve fazer as validações dos valores recebidos por post ou put

            $result = $this->read(null, $this->user->getEmail());

            if($result)
               throw new Exception("Email já existe",412);

            $sql = "INSERT INTO usuario (nome, email, senha)";
            $sql .= " values (:nome, :email, :senha)";

            $con = new Connection();
            $insert = $con->prepare($sql);
            $array = [
                ":nome"=>$this->user->getNome(),
                ":email"=>$this->user->getEmail(),
                ":senha"=>$this->user->getSenha()
            ];
            if(!$insert->execute($array))
                throw new \Exception("Não foi possivel inserir usuário",412);
            return [
                "msg"=>"Usuário inserido com sucesso !",
                "result"=>$this->read($con->lastInsertId())
            ];

        }catch (\Exception $e){
            throw new Exception(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }

    /**
     * @param $id
     * @return array|mixed
     * @throws Exception
     */
    public function delete($id)
    {
        //TODO:: De costume, nãos deleta o usuário, apenas muda o status para 0 (zero)
        $i = (int) $id;

        if($i == 0)
            throw new Exception("bad request",400);

        $result = $this->read($id);
        if(!$result)
            throw new Exception("Usuário não existe");

        try{
            $sql = "DELETE FROM usuario where id =:id";
            $con = new Connection();
            $delete = $con->prepare($sql);

            if(!$delete->execute(["id"=>$id]))
                throw new Exception("Não foi possivel excluir usuário",412);
            else
                return ["msg"=>"Usuário deletado com sucesso !"];
        }catch (\Exception $e){

        }
    }

    /**
     * @param $put
     * @param $id
     * @return array|mixed
     * @throws Exception
     */
    public function update($put, $id)
    {
        try{
            $this->user = new User($put->nome,$put->senha,$put->email);

            //TODO:: Deve fazer as validações dos valores recebidos por post ou put

            if(!$this->read($id))
                throw new Exception("Usuário não existe");

            $result = $this->read(null, $put->email);
            if($result){
                if($result["id"] != $id)
                    throw new Exception("Email já existe",412);
            }

            $sql = "UPDATE usuario SET nome =:nome, email =:email, senha =:senha where id =:id";

            $con = new Connection();
            $insert = $con->prepare($sql);
            $array = [
                ":nome"=>$this->user->getNome(),
                ":email"=>$this->user->getEmail(),
                ":senha"=>$this->user->getSenha(),
                ":id"=>$id
            ];

            if(!$insert->execute($array))
                throw new \Exception("Não foi possivel atualizar usuário",412);

            return [
                "msg"=>"Usuário atualizado com sucesso !",
                "result"=>$this->read($id)
            ];

        }catch (\Exception $e){
            throw new Exception(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }

    /**
     * @details recuperando um usuário especifico ou todos os usuários
     * @param null $id
     * @return mixed|void
     * @throws Exception
     */
    public function read($id = null, $email = null)
    {
        try{
            $sql = "SELECT * FROM usuario ";
            if(!is_null($id)){

                $i = (int) $id;
                if($i == 0)
                    throw new \Exception("bad request", 400);

                $sql .= "WHERE id =:id";
                $con = new Connection();
                $select = $con->prepare($sql);
                $select->execute(
                    [
                        ":id"=>$id
                    ]
                );
                $result = $select->fetchAll(\PDO::FETCH_ASSOC);
                if(!$result)
                    return $result;
                else
                    return $result[0];
            }else if (!is_null($email)){

                $sql .= "WHERE email =:email";
                $con = new Connection();
                $select = $con->prepare($sql);
                $select->execute(
                    [
                        "email"=>$email
                    ]
                );
                $result = $select->fetchAll(\PDO::FETCH_ASSOC);
                if(!$result)
                    return $result;
                else
                    return $result[0];
            }else{
                $con = new Connection();
                $select = $con->prepare($sql);
                $select->execute();
                $result = $select->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            }
        }catch (\Exception $e){
            throw new Exception(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
}