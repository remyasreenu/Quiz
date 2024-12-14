<?php 
session_start();


require_once('config.php');

$usrid='';

if (isset($_POST['start']) && $_POST['start']!='') {
    $_SESSION['user_id'] = bin2hex(random_bytes(8));
    $query1 = "INSERT INTO quiz_answers (`user`,`user_id`)
                                VALUES (
                                '".mysqli_real_escape_string($conn,$_POST['usr_name'])."','".mysqli_real_escape_string($conn,$_SESSION['user_id'])."'); ";
    $result = mysqli_query($conn,$query1);
    $usrid = mysqli_insert_id($conn);

    if ($usrid!='') {
      header("Location: index.php?id=".$usrid.'&q=1');
      exit;
    }
    
}
if (isset($_GET['q'])) {
   $qid=$_GET['q'];
}else{
    $qid='';
}

if (isset($_GET['e'])) {

   $query1 = "UPDATE `quiz_answers` SET is_edit= '1' WHERE user_id = '".$_SESSION['user_id']."' ";
   $result = mysqli_query($conn,$query1);
   $edit=$_GET['e'];


}else{
    $edit='';
}

$query = "SELECT * FROM `questions` WHERE q_id='".$qid."'";

$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);




?>
<!--index.html-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" 
        content="width=device-width,
        initial-scale=1.0" />
        <link rel="stylesheet" href="./styles.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title>Quiz</title>
    </head>
    <style type="text/css">
        
        h2 {
            font-size:21px;
            color: #333;
            margin-bottom: 30px;
            text-align:left;
        }
        .question-container {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .radio-option {
            display: block;
            margin-bottom: 15px;
            font-size: 16px;
            color: #555;
            text-align: left;
    margin-left: 55px;
    padding: 10px;
        }

        .radio-option input {
            margin-right: 10px;
        }

        .submit-btn {
            display: block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
         .question {
            font-weight: bold;
            color: #333;
            text-align: left;
        }
        .answer {
            color: #555;
            margin-left: 10px;
            text-align: left;
        }
        .ubutton{
            padding-right: 15px;
            background-color: #4339ac;
/*            border: 2px solid black;*/
            color: white;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 20px;
        }
        .cbutton{

            padding-right: 15px;
            background-color: green;
/*            border: 2px solid black;*/
            color: white;
            padding: 5px 10px;
            cursor: pointer;

        }
    </style>

    <body>
        <div class="containerNew">
            <header>
                <div>
                   <!--  <a href="./highscore.html">
                    <button class="scores-header" id="view-high-scores">View High Scores</button>
                    </a> -->
                </div>
            
            </header>
            <main class="quiz">
                <div id="quiz-start">
                    <div class="landing" id="start-screen">
                        <h1 id="top">
                        Online Quiz
                        </h1>
                            
                            <form id="step1" name="step1" method="POST" action="#" >
                              <?php  $query = "SELECT q.q_id,a.user,q.questions,a.answer,a.is_correct FROM quiz_answers a LEFT join questions q on a.question=q.q_id  where a.user_id='".$_GET['sess']."' GROUP by a.question;";

                                $result = mysqli_query($conn,$query);

                                $nex='<h1>Questions and Answers</h1>';

                                while($row = mysqli_fetch_assoc($result)) {

                                    if ($row['is_correct']=='yes') {
                                        $mark='<span>&#10004;</span>';
                                    }else if($row['is_correct']=='no'){
                                        $mark='<span>&#10006;</span>';

                                    }
                                
                                    $nex.='<div class=>
                                        <p class="question">'.$row['q_id'].'. Q: '.$row['questions'].'</p>
                                        <p class="answer">A: <b>'.$row['answer'].'</b> '.$mark.'</p>
                                    </div>';

                                    
                                }
                                $cquery="SELECT COUNT(question) as ques,(SELECT COUNT(is_correct) FROM `quiz_answers` WHERE is_correct='yes' and user_id='".$_GET['sess']."' ) as yes ,(SELECT COUNT(is_correct) FROM `quiz_answers` WHERE is_correct='no' and user_id='".$_GET['sess']."' ) as no FROM `quiz_answers` WHERE user_id='".$_GET['sess']."';";
                                $result = mysqli_query($conn,$cquery);
                                $count = mysqli_fetch_assoc($result);
                               $nex.= '<p class="question">Total Questions:'.$count['ques'].' </p>';
                               $nex.= '<p class="question">Passed:'.$count['yes'].' </p>';
                               $nex.= '<p class="question">Failed:'.$count['no'].' </p>';
                                echo $nex;

                                
                                session_destroy();
                                ?>
                            </form>
                    </div>
                </div>
            </main>
        </div>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </body>
   