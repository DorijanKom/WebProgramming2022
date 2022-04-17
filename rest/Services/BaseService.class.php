<?php

abstract class BaseService{

    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }

    public function getAll(){
        return $this->dao->getAll();
    }

    public function add($params){
        return $this->dao->add($params );
    }

    public function update($params, $id){
        return $this->dao->update($params,$id);
    }

    public function delete($id){
        return $this->dao->delete($id);
    }

}

?>