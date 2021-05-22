<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';


class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {

        $id = $this->get('id');
        
        if($id === null){
            $users = $this->user->getAllUsers();
        }else{
            $users = $this->user->getAllUsers($id);
        }



       if($users){
        $this->response(  [
            'status' => true,
            'message' => 'success',
            'data' => $users
        ], 200 );
       }else{
        $this->response(  [
            'status' => false,
            'message' => 'id data not found',
            
        ], 404 );
       }
    }

    public function index_delete(){
        $id = $this->delete('id');


        if($id === null ){
            $this->response(  [
                'status' => false,
                'message' => 'Masukan id',
                
            ], 400 );
        } else{
            if($this->user->deleteUsers($id) > 0 ){

                $this->response(  [
                    'status' => true,
                    'id' => $id,
                    'message' => 'success deleted'
                ], 200 );

            }else {
                $this->response(  [
                    'status' => false,
                    'message' => 'id Not Found!',
                ], 404 );
            }
        }
    }

    public function index_post(){
        $data = [
            'nama_lengkap' => $this->post('nama'),
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'telp' => $this->post('telpon')
        ];

        if($this->user->tambahUsers($data) > 0){

            $this->response(  [
                'status' => true,
                'message' => 'data has ben created',
            ], 201 );
        } else{
            $this->response(  [
                'status' => false,
                'message' => 'failed to created data',
            ], 400 );
        }
    }

    public function index_put(){

        $id = $this->put('id');
        $data = [
            'nama_lengkap' => $this->put('nama'),
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'telp' => $this->put('telpon')
        ];

        if($this->user->UpdateUsers($data,$id) > 0){

            $this->response(  [
                'status' => true,
                'message' => 'data has ben Modified',
            ], 200 );
        } else{
            $this->response(  [
                'status' => false,
                'message' => 'failed to Modified data',
            ], 400 );
        }
    }
}