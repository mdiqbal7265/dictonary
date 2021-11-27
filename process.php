<?php

    session_start();
    require_once "config.php";
    require_once "function.php";

    $action = $_POST['action'] ?? '';
    $status = 0;

    if(!$connection)
    {
        throw new Exception("Cannot connect to Database");
    }else{

        if('register' == $action)
        {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if($name && $email && $password)
            {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO user(name,email,password)VALUES('{$name}','{$email}','{$password_hash}')";
                mysqli_query($connection,$query);
                if(mysqli_error($connection))
                {
                    $status = 1;
                }else{
                    $status = 3;
                }
            }else{
                $status = 2;
            }
            header("Location: index.php?status={$status}");
        }else if('login' == $action)
        {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if($email && $password)
            {
                $query = "SELECT * FROM user WHERE email='{$email}'";
                $result = mysqli_query($connection,$query);
                if(mysqli_num_rows($result) > 0)
                {
                    $data = mysqli_fetch_assoc($result);
                    $_password = $data['password'];
                    $_id = $data['id'];
                    $_name = $data['name'];
                    $_email = $data['email'];
                    if(password_verify($password,$_password))
                    {
                        $_SESSION['id'] = $_id;
                        $_SESSION['name'] = $_name;
                        $_SESSION['email'] = $_email;
                        header("Location: dashboard.php");
                        die();
                    }else{
                        $status = 4;
                    }
                }else{
                    $status = 5;
                }
            }else{
                $status = 2;
            }
            header("Location: index.php?status={$status}");
        }elseif("addword" == $action)
        {
            $word = $_REQUEST['word'] ?? '';
            $meaning = $_REQUEST['meaning'] ?? '';
            $user_id = $_SESSION['id'] ?? 0;

            if($word && $meaning && $user_id)
            {
                $query = "INSERT INTO words ( word, meaning, user_id ) VALUES ( '{$word}','{$meaning}','{$user_id}' )";
                $result = mysqli_query($connection, $query);
                if($result)
                {
                    $status = 7;
                }else{
                    $status = 8;
                }
            }else{
                $status = 6;
            }
            header("Location: dashboard.php?status={$status}");
        }elseif("delete" == $action)
        {
            $id = $_POST['taskid'];
            if($id)
            {
                $query = "DELETE FROM words WHERE id = {$id} LIMIT 1";
                $result = mysqli_query($connection, $query);
                if($result)
                {
                    $status = 9;
                }else{
                    $status = 8;
                }
                header("Location: dashboard.php?status={$status}");
            }
        }elseif("logout" == $action)
        {
            logout();
        }

    }

