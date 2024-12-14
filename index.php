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

                       
                        <?php  if(isset($_GET['id'])&&$_GET['id']!='') { ?>
                           
                            <div class="question-container">
                                
                                <form id="q_Form" name="q_Form" class="validate form-horizontal" action="#" enctype='multipart/form-data' role="form" onSubmit="return false">
                                    
                                    <div id="first_sec">

                                    <h2><?php echo $data['q_id'].'. '.$data['questions']; ?></h2>

                                    <?php
                                    $opts = explode(",", $data['options']);
                                    foreach ($opts as $val) { ?>
                                        <label class="radio-option">
                                        <input type="radio" name="answer" id="ans_<?php echo $data['q_id']; ?>" value="<?php echo $val; ?>"> <?php echo $val; ?>
                                        </label>
                                    <?php } ?>
                                    <input type="hidden" name="user" value="<?php echo $_GET['id']; ?>"> 
                                    <input type="hidden" name="question"  id="qusid" value="<?php echo $data['q_id']; ?>"> 
                                    <button type="submit"  class="submit-btn">Submit</button>
                                    </div>
                                    <div id="next_sec">
                                    </div>
                                    
                                </form>
                            </div>
                        <?php } else { ?>
                            <p>
                            Try to answer the following code-related questions with in the time limit. Keep in mind that incorrect answers will penalize your score!
                            </p>
                            <form id="step1" name="step1" method="POST" action="#" >
                                <div class="mb-3 mar-b10">
                                    <label for="exampleInputText" class="form-label">Enter Your Name</label>
                                    <input type="text" class="form-control" id="name" name="usr_name" placeholder="Enter Name here">
                                </div>
                                <button type="submit" id="start" name="start" value="1">Start Quiz</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </body>
   <script type="text/javascript">
       $(document).ready(function() {
            
            $('#q_Form').on('submit', function(event) {
                event.preventDefault(); 
                
                
                var formData = $(this).serialize();
                var de_form = decodeURIComponent(formData);
                
                // AJAX request
                $.ajax({
                    url: 'script.php', 
                    type: 'POST',
                    data: de_form,
                    success: function(response) {


                        if (response=='False') {

                            alert("Please Select the Answer")
                            return false;
                        }else{

                            $('#first_sec').hide();
                            //$('#qusid').hide();

                            $('#next_sec').html(response);

                        }

                        
                        

                    },
                    error: function(xhr, status, error) {
                        $('#response').html('Error: ' + error);
                    }
                });
            });
        });
   </script>