<?php
class users{

    function getUserDetails($username, $con){
        $sql = "select * from users where username='$username'";
        $result = $con->query($sql);

        $row = $result->fetch_assoc();
        return $row;
    }

    function getNoFollowers($username, $con){
        $sql = "select * from follows where followed_username='$username'";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    function getNoFollows($username, $con){
        $sql = "select * from follows where follower_username='$username'";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    function getNoMemes($username, $con){
        $sql = "select * from memes where username='$username'";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    function getNoLikes($username, $con){
        $sql = "select * from likes where username='$username'";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    function getUserMemes($username, $con){
        $sql = "select users.picture as pic, memes.post as meme, memes.Title as title, date_time as date_meme, 'test' as date_original, memes.username as username, '1' as type
        from memes INNER JOIN users
        on memes.username = users.username
        and memes.username='$username'
        order by date_meme DESC"
        ;

        $result = $con->query($sql);
        return $result;
    }

    function isFollowing($username, $follower_username, $con)
    {
        $sql = "select * from follows where follower_username='$follower_username' and followed_username='$username'";
       
        $res = $con->query($sql);
        $num = $res->num_rows;
        if($num>0)
            return 'yes';
        else
            return 'no';
    }

    function followUser($following, $follower, $dateFollow, $con){

        $isFollowing = $this->isFollowing($following, $follower, $con);
        //echo $isFollowing;
        $sql = "";
        if($isFollowing=='yes'){
            $sql = "delete from follows where follower_username='$follower' and followed_username='$following'";
        }
        else{
            $sql = "insert into follows(followed_username, follower_username, date_time) values ('$following', '$follower', '$dateFollow')";
        }
        //echo $sql;
        if($con->query($sql)===TRUE)
            return "success";
        else
            return "error";

    }

}
?>