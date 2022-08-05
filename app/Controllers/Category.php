<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;

class Category extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }
    public function index()
    {
        $data = $this->model->findAll();
        $result = [
            'status' => 200,
            'data'=>$data
        ];
        return $this->respond($result, 200) ;
    }
    
    public function create(){
        $data =[
            'title'=>$this->request->getPost('title'),
            'parent_id'=>$this->request->getPost('parent_id')
        ];
        $this->model->save($data);
        $result =[
            'message'=>'success',
            'data'=> $data
        ];
        return $this->respond($result);
    }
}
