<?php
class likememe{

function likeMeme($username, $meme_id, $con){

$numLikes = $this->noLikes($meme_id, $con);

$sql = "select * from likes where username='$username' and meme_id='$meme_id'";
$res = $con->query($sql);
$num = $res->num_rows;

if($num>0){
    $sqlDelete = "delete from likes where username='$username' and meme_id='$meme_id'";
    if($con->query($sqlDelete)===TRUE){
        $numLikes = $numLikes-1;
        return "deleted-".$numLikes;
    }
}
else{

    $datetime = date('Y-m-d H:i:s');
    $sqlInsert = "insert into likes values ('$username', '$meme_id', '$datetime')"; 
    if($con->query($sqlInsert)===TRUE){
        $numLikes = $numLikes+1;
        return "inserted-".$numLikes;
    }
}
}
?>