<?php


class Employee extends DB
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $result = mysqli_query($this->con, "SELECT
                                              em.*,
                                              adr.address as address,
                                              adr.id as address_id,
                                              ph.number as phone,
                                              ph.id as phone_id
                                            FROM employees  em
                                            LEFT JOIN addresses adr
                                              ON em.id=adr.employee_id
                                            LEFT JOIN phones ph
                                              ON em.id=ph.employee_id
                                            ORDER BY em.id");

        $data = [];

        if($result) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                array_push($data, $row);
            }
        }
     

        $relations = ['phone', 'address'];
        $r = [];
        foreach ($relations as $relation) {
            $r[$relation.'_key'] = [];
            $r[$relation.'_key'] = [];
        }
        $newData = [];
        $newDataKeys = [];
        $newKey = 0;
        foreach($data as $key => $value){

            if(!in_array($value["id"], $newDataKeys)){
                ++$newKey;
                $newData[$newKey]["id"] = $value["id"];
                $newData[$newKey]["firstName"] = $value["firstName"];
                $newData[$newKey]["lastName"] = $value["lastName"];
                $newData[$newKey]["age"] = $value["age"];
                $newData[$newKey]["city"] = $value["city"];
                $newData[$newKey]["email"] = $value["email"];
                $newData[$newKey]["country"] = $value["country"];
                $newData[$newKey]["bankAccountNumber"] = $value["bankAccountNumber"];
                $newData[$newKey]["creditCardNumber"] = $value["creditCardNumber"];
            }

            foreach ($relations as $relation) {
                if(! in_array( $value[$relation.'_id'], $r[$relation.'_key']))
                    $newData[$newKey][$relation][$key] = $value[$relation];

                array_push($r[$relation.'_key'], $value[$relation.'_id']);
            }

            array_push($newDataKeys, $value["id"]);

        }

        return $newData;

    }

    function exist($data, $id){

        foreach ($data as $k => $value){
            if($value['id'] == $id){
                return true;
            }
        }

        return false;
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