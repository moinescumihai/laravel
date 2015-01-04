<?php namespace App\DB\Repositories;

use App\DB\RepositoryContracts\Repository as RepositoryContract;

abstract class Repository implements RepositoryContract{
    
    protected $model;
    
    public function all(){
        return $this->model->all();
    }
    
    public function find($id){
        return $this->model->find($id);
    }
       
    public function destroy($id){
        return $this->model->destroy($id);
    }
    
    public function store($data){
        return $this->model->create($data);
    }
    
    public function update($id, $data){
        return $this->model->update($data)->where('id','=',$id);
    }
   
}
