<?php
session_start();

require_once('config.php');



    if ((!isset($_REQUEST['answer']) || $_REQUEST['answer']=='')) {
        
        echo "False";
        exit();
    }
    else{

    $answer=$_REQUEST['answer'];


    }






$qus=$_REQUEST['question'];


$user=$_REQUEST['user'];




$query = "SELECT answer FROM `questions` WHERE q_id='".$_REQUEST['question']."';";

$result = mysqli_query($conn,$query);
$ques = mysqli_fetch_assoc($result);

if ($ques['answer']==$_REQUEST['answer']) {
    
    $ans='yes';
}else{
    $ans='no';

}



$q_query = "SELECT question,user,is_edit FROM `quiz_answers` WHERE user_id='".$_SESSION['user_id']."';";

$q_result = mysqli_query($conn,$q_query);
$q_ques = mysqli_fetch_assoc($q_result);



if ($q_ques['is_edit']==1 || ($q_ques['question']==NULL || $q_ques['question']=='')) {

    if ($q_ques['is_edit']==1) {
        $cond="and question=".$qus."";
    }else{
        $cond='';
    }
    
    $query1 = "UPDATE `quiz_answers` SET
                            
                            question = '".$qus."',
                            answer = '".$answer."',
                            is_correct = '".$ans."',
                            done_on=NOW()
                            WHERE user_id = '".$_SESSION['user_id']."' $cond  ";


}else{
    $usrid=$_SESSION['user_id'];

    $query1 = "INSERT INTO quiz_answers (`user`,`user_id`,`question`,`answer`,`is_correct`,`done_on`)
                                VALUES ('".$q_ques['user']."','".$usrid."',$qus,'".$answer."','".$ans."',NOW()); ";

    
}

$result = mysqli_query($conn,$query1);


if ($result==1){

    $nex_qus=$qus+1;

    $query = "SELECT * FROM `questions` WHERE q_id=$nex_qus";

    $result = mysqli_query($conn,$query);
    $ques = mysqli_fetch_assoc($result);

    if ($nex_qus<6) {

        $nex="<h2>".$ques['q_id'].".".$ques['questions']."</h2>";
        $opts = explode(",", $ques['options']);
        foreach($opts as $val) {

        $nex.='<label class="radio-option">
                                            <input type="radio" name="answer" id="ans_'.$ques['q_id'].'" value="'.$val.'">'.$val.'
                                            </label>';

        }
        $nex.='<input type="hidden" name="user" value="'.$user.'"> 
                                        <input type="hidden" name="question" id="qusid" value="'.$ques['q_id'].'"> 
                                        <button type="submit"  class="submit-btn">Submit</button>';   

        echo $nex;
    }else{


        $query = "SELECT q.q_id,a.user,q.questions,a.answer FROM quiz_answers a LEFT join questions q on a.question=q.q_id  where a.user_id='".$_SESSION['user_id']."' GROUP by a.question;";

        $result = mysqli_query($conn,$query);

        $nex='<h1>Questions and Answers</h1>';

        while($row = mysqli_fetch_assoc($result)) {
        
            $nex.='<div class=>
                <p class="question">'.$row['q_id'].'. Q: '.$row['questions'].'</p>
                <p class="answer">A: '.$row['answer'].'</p>
            </div>';

            
        }


        $nex.='<a href="index.php?id='.$user.'&q=1&e=1" class="ubutton">Update Answer</a>';
        $nex.='<a href="view.php?sess='.$_SESSION['user_id'].'" class="cbutton">Confirm</a>';
        echo $nex;
        


    }

    
}



?>