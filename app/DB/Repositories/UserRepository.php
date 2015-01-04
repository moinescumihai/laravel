<?php namespace App\DB\Repositories;

use App\DB\Models\User;
use App\DB\RepositoryContracts\UserRepository as RepositoryContract;

use Illuminate\Contracts\Hashing\Hasher as Hash;


class UserRepository extends Repository implements RepositoryContract{
    
    protected $hash;
    
    function __construct(User $model, Hash $hash){
        $this->model = $model;
        $this->hash = $hash;
    }
    
    public function store($requestData){
        return parent::store([
            'name'      =>  $requestData->name,
            'email'     =>  $requestData->email,
            'password'  =>  $this->hash->make($requestData->password)
        ]);
    }
    
    public function update($requestData, $id){
        $data['name'] = $requestData->name;
        if(array_key_exists('password', $requestData)){
            $data['password'] = $this->hash->make($requestData->password);
        }
        return parent::update($id, $data);
    }
  
    
    
}
