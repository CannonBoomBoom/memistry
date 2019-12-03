<?php
class post{

    function getPostDetails($conn){
        $sql = "SELECT `image`, `title` FROM `post`";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        return $row;
    }

    function getPostComments($conn){
        $sql = "select user.picture as pic, tweets.content as tweet_text, date_time as date_tweet, 'test' as date_original, tweets.username as username, '1' as type
        from tweets INNER JOIN user
        on tweets.username = user.username
        and tweets.username='$username'
        UNION
        select user.picture as pic, tweets.content as tweet_text,
        retweets.date_time as date_tweet, tweets.date_time as date_original, tweets.username as username, '2' as type
        from tweets INNER JOIN retweets
        ON tweets.tweet_id = retweets.retweet_tweet_id
        INNER JOIN user
        ON tweets.username = user.username
        where retweets.retweet_username='$username'
        order by date_tweet DESC"
        ;

        $result = $conn->query($sql);
        return $result;
    }
}
?>