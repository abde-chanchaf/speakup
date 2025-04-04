<?php
require_once '../config.php';
$id_am = intval($_GET['id_am']);
if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
} else {
   $id = isset($_COOKIE['id']);
}

$sql1 = "UPDATE message 
         JOIN conversation ON message.id_cv = conversation.id_cv 
         SET message.vue_ms = 1 
         WHERE conversation.id_am = $id_am and message.id_send!=".$id."";
mysqli_query($con, $sql1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>SpeakUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 

  <style>
    body { height:100vh; width:100vw; margin: 0; }
    .chatbox {
      max-width: 600px;
      margin: auto;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      height: 90vh;
      
    }
    .chatbox-header {
      padding: 10px;
      background-color: #0d6efd;
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .chatbox-body {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      background-color: #f8f9fa;
      position:relative;
    }
    .chatbox-message {
      margin-bottom: 200px;
      height: auto;
      position:absolute;
      left: 10px;
      color:white;
      border-radius:10px;
      background-color:gray;
      max-width:300px;
    }
    .chatbox-message1 {
      margin-bottom: 50px;
      height: auto;
      position:absolute;
      right: 10px;
      color:white;
      border-radius:10px;
      background-color:green;
      max-width:300px;

    }
    
    .chatbox-footer {
      padding: 10px;
      border-top: 1px solid #dee2e6;
      background-color: #fff;
    }
   
  .rtn {
    
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: black;
    
 }a{
  color: black;
 }
 </style>
 
</head>
<body>
<input type="hidden" id="id_am" value="<?= $id_am ?>">
<input type="hidden" id="id_session" value="<?= $id ?>">

<div class="chatbox shadow mt-2">
  <div class="chatbox-header">
  
    <h5 class="mb-0">Chat Support</h5>
    <button class="rtn">
    <a href="../index.php"> <i class="fas fa-arrow-left"></i></a>
        </button>
  </div>
  <div class="chatbox-body" id="chatBody"></div>
  <div class="chatbox-footer">
    <form id="chatForm" method="post">
      <div class="input-group">
        <input type="text" class="form-control" name="message" id="message" placeholder="Écrire un message..." required>
        <button class="btn btn-primary" type="submit">Envoyer</button>
      </div>
    </form>
  </div>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $message=$_POST['message'];
  $sql= "SELECT * FROM `conversation` WHERE id_am=$id_am";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result);
  $sql1="INSERT INTO `message`(`id_send`,`content`,`id_cv`) 
          VALUES ('".$_SESSION['id']."','$message','".$row['id_cv']."')";
  $result1= mysqli_query($con, $sql1);
  
  header("location:conversation.php?id_am=$id_am");
}


?>

<script>
const chatbody = document.getElementById("chatBody");
const id_am = document.getElementById("id_am").value;
const id_session = document.getElementById("id_session").value;

async function fetchMessages() {
  try {
    const res = await fetch('json.php?id_am='+id_am);
    const data = await res.json();
    chatbody.innerHTML = "";

    data.forEach(msg => {
      const wrapper = document.createElement('p');
      const p=document.createElement('p');
      const messageDiv = document.createElement('div');
      const br=document.createElement('br');
      const br2=document.createElement('br');
      messageDiv.classList.add(  "p-2", "rounded");
      messageDiv.innerHTML = msg.content;

      if (msg.id_send == id_session) {
        wrapper.classList.add("chatbox-message");
        
      } else {
        wrapper.classList.add("chatbox-message1");
      }

      wrapper.appendChild(messageDiv);
      chatbody.appendChild(wrapper);
      chatbody.appendChild(br);
      chatbody.appendChild(br2);
      
    });

    chatbody.scrollTop = chatbody.scrollHeight;
  } catch (error) {
    console.error("Erreur:", error);
  }
}



// fetchMessages();
setInterval(fetchMessages, 100);
</script>
</body>
</html>