<?php


class Employee extends DB
{

    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $result = mysqli_query($this->con, "SELECT
                                              em.*,
                                              GROUP_CONCAT(em.id) as phones,
                                              ph.number as phone
                                            FROM employees  em

                                            LEFT JOIN phones ph
                                              ON em.id=ph.employee_id
                                            ORDER BY em.id");

        $data = [];

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

//        foreach ($data as $k => $value) {
//            $this->id  =$k;
//            if($k != 0) {
//                if ($value['id'] == $data[$k - 1]['id']) {
//
//                    $data[$k]['phones'] = [];
//                    array_push($data[$this->id]['phones'], $value['phone']);
//                }
//            }
//
//        }


        echo '<pre>';
        print_r($data);
        return $data;
    }

    public function delete($ids)
    {
        foreach($ids as $id){
            mysqli_query($this->con, "DELETE FROM employees WHERE id=$id");

        }
    }

    public function update($id, $data)
    {

        $sql = "UPDATE employees SET ";
        foreach ($data as $key => $value) {

            if(count($data) > array_search($key, array_keys($data)) + 1)
                $sql = $sql." $key='$value', ";
            else
                $sql = $sql." $key=$value ";
        }
        $sql = $sql." WHERE id=$id";

        mysqli_query($this->con, $sql);

        if (!mysqli_query($this->con, $sql)) {
            print_r(mysqli_error_list($this->con));
        }

    }
}