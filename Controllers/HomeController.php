<?php




class HomeController
{

    public function index(){
        $db = new DB();

        $data = $db->table('users')->where('email', 'dav.mnatsakanyan@gmail.com')->get();
var_dump($data);
//        foreach ($data as $d) {
//            print_r($d);
//        }



    }
}