<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BlogModel;
class Blog extends BaseController{
    use ResponseTrait;
    public function __construct()
    {
        $this->model = new BlogModel();
    }

    public function index(){
        $this->model->dataMap('blog','id','parent_id','blog');
    }
    public function create()
    {
        $model = new BlogModel();
        $data = [
            'blog' => $this->request->getPost('blog'),
            'parent_id'=>$this->request->getPost('parent_id')
        ];
        //$data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($response, 201);
    }

    
}