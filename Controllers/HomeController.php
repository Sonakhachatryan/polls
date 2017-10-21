<?php
namespace  Controllers;

use Core\Request;
use Models\Poll;

/**
 * Class HomeController
 * @package Controllers
 */
class HomeController
{
    /**
     * view home page
     *
     * @return mixed
     */
    public function index()
    {
        return view('index');
    }

    /**
     * returns the banner view
     *
     * @param int $id
     * @return mixed
     */
    public function banner($id)
    {
        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id,false);

        return view('banner',['poll' => $poll]);
    }

    public function vote($id)
    {
        Request::set();
        $request = Request::get();
//        dd($request);
        $pollModel = new Poll();

        $pollModel->voteForAnswer($request['answerId'],$id);
        $poll = $pollModel->getPollById($id,false);

        echo json_encode($poll) ;

    }

}