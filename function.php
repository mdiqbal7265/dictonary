<?php

    require_once "config.php";
    // $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    // mysqli_set_charset($connection,"utf8");
    // if(!$connection)
    // {
    //     throw new Exception("Cannot connect to database");
    // }


    function getStatusMessage($statusCode = 0)
    {
        $status = [
            '0' => '',
            '1' => 'Duplicate Email Addres ):',
            '2' => 'Email Or password Empty!',
            '3' => 'User Created Succesfully!!',
            '4' => 'Email & Password didn\'t match!',
            '5' => 'Email doesn\'t exists',
            '6' => 'Field doesn\'t empty!. Data Not added. Try it again carefully!',
            '7' => 'Data added Succesfully!!',
            '8' => 'Something went wrong!! Please try again later',
            '9' => 'Data Deleeted Succesfully!!'
        ];

        return $status[$statusCode];
    }

    function is_authenticate($id = 0)
    {
        $user_id = $id;
        if($user_id)
        {
            return header("Location: dashboard.php");
        }
    }

    function is_not_login($id)
    {
        $user_id = $id;
        if(!$user_id)
        {
            return header("Location: index.php");
        }
    }

    function logout()
    {
        $_SESSION['id'] = 0;
        session_destroy();
        return header("Location: index.php");
    }

    function getWords($user_id, $search="")
    {
        global $connection;
        if($search)
        {
            $query = "SELECT * FROM words WHERE user_id = '{$user_id}' AND word LIKE '{$search}%' ORDER BY word";
        }else{
            $query = "SELECT * FROM words WHERE user_id = '{$user_id}' ORDER BY word";
        }
        $result = mysqli_query($connection, $query);
        $data=[];
        while($_data = mysqli_fetch_assoc($result))
        {
            array_push($data, $_data);
        }

        return $data;
    }