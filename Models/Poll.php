<?php

namespace Models;

use Core\Auth;
use PDO;

class Poll extends DB
{

    private $tableName = 'polls';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get paginated polls
     *
     * @param integer $page
     * @param bool $forUser
     * @return mixed
     */
    public function getPolls($page, $forUser = true)
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS $this->tableName.*,users.name,users.email 
                FROM $this->tableName 
                LEFT JOIN users on users.id = $this->tableName.user_id ";

        if ($forUser) {
            $sql .= " WHERE user_id=:userId ";
        }


        $sql .= " ORDER BY `id` DESC LIMIT " . ($page - 1) * 10 . ",10";

        $sth = $this->dbh->prepare($sql);
        $data = [];
        if ($forUser) {
            $data[':userId'] = Auth::user()['id'];
        }
        $sth->execute($data);
        $polls = $sth->fetchAll();
        $result['polls'] = $polls;

        $sql = "SELECT FOUND_ROWS()";
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        $pages = $sth->fetch();

        $result['pages'] = ceil(intval($pages) / 10);


        return $result;

    }

    /**
     * create new poll record
     *
     * @param array $data
     */
    public function createPoll($data)
    {
        $sql = "INSERT INTO $this->tableName (`title`, `question`, `user_id`,`created_at`) VALUES (:title,:question,:userID,:createdAt)";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':title', $data['title']);
        $sth->bindParam(':question', $data['question']);
        $userId = Auth::user()['id'];
        $sth->bindParam(':userID', $userId);
        $date = date('Y-m-d H:i:s', time());
        $sth->bindParam(':createdAt', $date);
        $sth->execute();
        $pollId = $this->dbh->lastInsertId();
        if ($pollId) {
            $sql = "INSERT INTO answers (`poll_id`,`label`,`created_at`) VALUES ";

            foreach ($data['answers'] as $answer) {
                $sql .= "(" . $pollId . ",'" . $answer . "','" . date('Y-m-d H:i:s', time()) . "'),";
            }

            $sql = rtrim($sql, ',');
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
        }

    }

    /**
     * update poll record
     *
     * @param array $data
     */
    public function updatePoll($data,$id)
    {
        $sql = "UPDATE $this->tableName SET `title` = :title, `question` = :question WHERE `id`=:id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':title', $data['title']);
        $sth->bindParam(':question', $data['question']);
        $sth->bindParam(':id', $id);
        $sth->execute();
        $pollId = $id;
        if ($pollId) {
            $sql = "INSERT INTO answers (`poll_id`,`label`,`created_at`) VALUES ";

            foreach ($data['answers'] as $answer) {
                $sql .= "(" . $pollId . ",'" . $answer . "','" . date('Y-m-d H:i:s', time()) . "'),";
            }

            $sql = rtrim($sql, ',');
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
        }

    }

    /**
     * get single poll
     *
     * @param $id
     * @param bool $forUser
     * @return array
     */
    public function getPollById($id, $forUser = true)
    {
        $sql = "SELECT $this->tableName.*, 
                       `answers`.`poll_id` as poll_id,
                       `answers`.`label` as label,
                       `answers`.`id` as answer_id,
                       `answers`.`created_at` as answer_created_at,
                       `answers`.`choosen` as choosen,
                       `users`.name as name,
                       `users`.email as email
                FROM $this->tableName 
                    LEFT JOIN `answers` on `answers`.`poll_id` = $this->tableName.`id`
                    LEFT JOIN users on users.id = $this->tableName.user_id 
                WHERE $this->tableName.`id`=:id ";

        if ($forUser) {
            $sql .= " AND $this->tableName.`user_id`=:userId ";
        }

        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        if ($forUser) {
            $userId = Auth::user()['id'];
            $sth->bindParam(':userId', $userId, PDO::PARAM_INT);
        }
        $sth->execute();
        $poll = $sth->fetchAll();

        if (count($poll)) {
            $pollArray = [
                'id' => $poll[0]['id'],
                'title' => $poll[0]['title'],
                'question' => $poll[0]['question'],
                'user_id' => $poll[0]['user_id'],
                'total_answered' => $poll[0]['total_answered'],
                'created_at' => $poll[0]['created_at'],
                'name' => $poll[0]['name'],
                'email' => $poll[0]['email']
            ];

            $pollArray['answers'] = [];
            foreach($poll as $k => $v){
                $answerArray = [
                    'id' => $v['answer_id'],
                    'poll_id' => $v['poll_id'],
                    'label' => $v['label'],
                    'choosen' => $v['choosen'],
                    'created_at' => $v['answer_created_at']
                ];

                array_push($pollArray['answers'],$answerArray);
            }
        }

        return $pollArray;
    }

    /**
     * get the poll by answer id
     *
     * @param integer $answerId
     * @param bool $forUser
     * @return array
     */
    public function getPollByAnswer($answerId,$forUser = true)
    {
        $sql = "SELECT $this->tableName.* FROM $this->tableName 
                    LEFT JOIN `answers` on `answers`.`poll_id` = $this->tableName.`id`
                WHERE answers.`id`=:id ";

        if ($forUser) {
            $sql .= " AND $this->tableName.`user_id`=:userId ";
        }

        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $answerId, PDO::PARAM_INT);
        if ($forUser) {
            $userId = Auth::user()['id'];
            $sth->bindParam(':userId', $userId, PDO::PARAM_INT);
        }
        $sth->execute();
        $poll = $sth->fetchAll();

        return $poll;
    }

    /**
     * delete the answer
     *
     * @param $answerId
     * @return bool
     */
    public function removeAnswer($answerId)
    {
        $sql = "DELETE FROM `answers` WHERE answers.`id`=:id ";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $answerId, PDO::PARAM_INT);
        return $sth->execute();
    }


    /**
     * delete the poll
     *
     * @param $answerId
     * @return bool
     */
    public function removePoll($answerId)
    {
        $sql = "DELETE FROM $this->tableName WHERE $this->tableName.`id`=:id ";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $answerId, PDO::PARAM_INT);
        return $sth->execute();
    }

    /**
     * vote for answer
     *
     * @param $answerId
     */
    public function voteForAnswer($answerId,$pollId)
    {
        $sql = 'UPDATE answers SET choosen = choosen + 1 WHERE `id` = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $answerId, PDO::PARAM_INT);
        $sth->execute();

        $sql = "UPDATE $this->tableName SET total_answered = total_answered + 1 WHERE `id` = :id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $pollId, PDO::PARAM_INT);
        $sth->execute();
    }



}