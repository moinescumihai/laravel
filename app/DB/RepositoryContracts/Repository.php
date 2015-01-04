<?php namespace App\DB\RepositoryContracts;

interface Repository {
    public function all();
    
    public function find($id);
    
    public function destroy($id);

    public function store($requestData);

    public function update($requestData, $id);

}
