<?php

namespace Controllers;

use Core\Auth;
use Core\Request;
use Models\Poll;

/**
 * Class PollController
 * @package Controllers
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
        if (!Auth::check('user')) {
            return view('auth/login');
        };

        $pollsModel = new Poll();
        $data = $pollsModel->getPolls($page);

        return view('poll/index', ['polls' => $data['polls'], 'pages' => $data['pages'], 'page' => $page]);
    }

    /**
     * return polls create view
     *
     * @param int $page
     * @return view
     */
    public function showCreateForm()
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        };

        return view('poll/create');
    }

    /**
     * create new poll
     */
    public function createPoll()
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        Request::set();
        $request = Request::get();

        //validate request params
        $errors = $this->validateInput($request);
        if (count($errors)) {
            return view('poll/create', ['errors' => $errors, 'data' => $request]);
        }

        $pollModel = new Poll();
        $pollModel->createPoll($request);

        return redirect('dashboard');
    }

    /**
     * get single poll for view
     *
     * @param $id
     * @return  view
     */
    public function view($id)
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id);

        return view('poll/view',['poll' => $poll]);
    }

    /**
     * get single poll for view
     *
     * @param $id
     * @return  view
     */
    public function edit($id)
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id);

        return view('poll/edit',['poll' => $poll]);
    }

    /**
     * update a poll
     *
     * @param $id
     */
    public function update($id)
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        Request::set();
        $request = Request::get();

        //validate request params
        $errors = $this->validateInput($request,true);
        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id);

        if (count($errors)) {
            return view('poll/edit', ['errors' => $errors, 'poll' => $poll]);
        }
        if($poll){
            $pollModel->updatePoll($request,$poll['id']);
            return redirect('poll/view?id=' . $poll['id']);
        }

        return redirect('dashboard');
    }

    /**
     * remove answer
     *
     * @param $id
     */
    public function removeAnswer($id)
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollByAnswer($id);
        if(count($poll)){
            $pollModel->removeAnswer($id);
            return redirect('poll/edit?id=' . $poll[0]['id']);
        }

        return redirect('dashboard');
    }

    /**
     * remove poll
     *
     * @param $id
     */
    public function delete($id)
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        $pollModel = new Poll();
        $poll = $pollModel->getPollById($id);
        if($poll){
            $pollModel->removePoll($id);
        }

        return redirect('dashboard');
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