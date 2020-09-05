<?php
class post{

    function getUserDetails($postid, $con){
        $sql = "select * from post where postid='$postid'";
        $result = $con->query($sql);

        $row = $result->fetch_assoc();
        return $row;
    }
}
?>