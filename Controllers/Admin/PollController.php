<?php

namespace Controllers\Admin;

use Core\Auth;
use Core\Request;
use Models\Poll;

/**
 * Class PollController
 * @package Controllers\Admin
 */
class PollController
{
    /**
     * return polls index view
     *
     * @param int $page
     * @return view
     */
    public function index($page = 1)
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        };

        $pollsModel = new Poll();
        $data = $pollsModel->getPolls($page,false);

        return view('poll/index', ['polls' => $data['polls'], 'pages' => $data['pages'], 'page' => $page, 'admin' => true]);
    }

    /**
     * get single poll for view
     *
     * @param $id
     * @return  view
     */
    public function view($id)
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id,false);

        return view('poll/view',['poll' => $poll, 'admin' => true]);
    }

    /**
     * get single poll for view
     *
     * @param $id
     * @return  view
     */
    public function edit($id)
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id);

        return view('poll/edit',['poll' => $poll,'admin' => true]);
    }

    /**
     * update a poll
     *
     * @param $id
     */
    public function update($id)
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        }

        Request::set();
        $request = Request::get();

        //validate request params
        $errors = $this->validateInput($request,true);
        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id);

        if (count($errors)) {
            return view('poll/edit', ['errors' => $errors, 'poll' => $poll,'admin' => true]);
        }
        if($poll){
            $pollModel->updatePoll($request,$poll['id']);
            return redirect('admin/poll/view?id=' . $poll['id']);
        }

        return redirect('admin/dashboard');
    }

    /**
     * remove answer
     *
     * @param $id
     */
    public function removeAnswer($id)
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollByAnswer($id);
        if(count($poll)){
            $pollModel->removeAnswer($id);
            return redirect('admin/poll/edit?id=' . $poll[0]['id']);
        }

        return redirect('admin/dashboard');
    }

    /**
     * remove poll
     *
     * @param $id
     */
    public function delete($id)
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id,false);
        if($poll){
            $pollModel->removePoll($id);
        }

        return redirect('admin/dashboard');
    }
    /**
     * validate input data
     *
     * @param array $request
     * @param bool $update
     * @return array
     *
     */
    public function validateInput($request,$update = false)
    {
        $errors = [];

        if (!isset($request['title']) || !$request['title']) {
            $errors['title'] = 'Title is required.';
        }

        if (!isset($request['question']) || !$request['question']) {
            $errors['question'] = 'Question is required.';
        }

        if(!$update) {
            foreach ($request['answers'] as $answer) {
                if (!$answer)
                    $errors['answers'] = 'Question must have at least one answer and inputs must not be blank';
            }
        }


        return $errors;
    }

}