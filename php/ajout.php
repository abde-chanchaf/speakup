<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
        body {
            font-family: Arial, sans-serif;
        }
        .card {
            width: 320px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .info {
            flex-grow: 1;
        }
        .name {
            font-size: 20px;
            font-weight: bold;
            position: absolute;
            left: 75px;
            top: 18px;
        }
        .mutual-friends {
            font-size: 14px;
            color:rgb(155, 154, 154);
            display: flex;
            align-items: center;
            gap: 5px;
            position: absolute;
            left: 70px;
            top: 18px;
        }
        .mutual-friend-pic {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            object-fit: cover;
        }
        .add-friend-btn {
            width: 75px;
            padding: 8px 0;
            border: none;
            border-radius: 5px;
            background-color: #e7f3ff;
            color: #1877F2;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            position: absolute;
            right: 10px;
            top: 20px;
            
        }
        a{
            text-decoration:none;
            font-size:15px;
        }
        ul{
            list-style-type: none;
        }
        li{
            margin-bottom:5px;
        }
        .saerch{
            width: 250px;
            height: 0px;
            outline: none;
            border:none;
            padding: 15px;  
            position: absolute;
            
            font-size:17px;
            border-radius:20px; 
             
        }
        .saerchc{
            width: 300px;
            height: 30px;
            border-radius:20px;
            border: 2px solid black; 
            position: relative;
            margin-left:55px;
            margin-bottom:15px;
            display:flex;
            justify-content:center;
            align-items:center;
                
        }
        .saerchc i{
             font-size:20px;
            position: absolute;
            right: 15px;
            top:-20;
                
        }
</style>


     <div class="saerchc">
     <input type="text" class="saerch" name="saerch" id="saerch">
     <i class="fa-solid fa-magnifying-glass"></i>
     </div>

<ul>
 <?php


           $sql='SELECT * FROM `user` where id_us!=3';
           $result=mysqli_query($con,$sql);
           while ($row=mysqli_fetch_array($result)) {
            $sql1="SELECT * FROM `amis` where id_us1=3 and id_us2=".$row['id_us']."
                   or id_us2=3 and id_us1=".$row['id_us']."";
            $result1=mysqli_query($con,$sql1);
               
              if ($result1->num_rows <= 0) {
                //    echo $row['id_us'];
                //    echo $row['role_us'];
                //    echo $row['img_us'];
                //    echo $row['email_us'];
                //    echo $row['name_us'];
                //    echo $row['pass_us'];
                //    echo $row['nickname_us'];
                //    echo '<br>';

                   echo '<li class="card">
            
           <img src="images/'.$row['img_us'].'" alt="Photo de profil" class="profile-pic">
            <div class="info">
            <strong class="name">'.$row['nickname_us'].'</strong>
             <h5 class="mutual-friends">'.$row['name_us'].'</h5>
            
            <a href="php/ajout2.php?id_aj='.$row['id_us'].'" class="add-friend-btn">Add</a>
           </div>
              
        </li>';
              }
 
    }
   
 ?>
</ul>
  
<script>
    function filterajout() {
    var input = document.getElementById("saerch").value.toLowerCase();
    var items = document.getElementById("friendsList li");


    // for (var i = 0; i < items.length; i++) {
    //     var nickname = items[i].querySelector(".name").textContent.toLowerCase();
    //     var name = items[i].querySelector(".mutual-friends").textContent.toLowerCase();

    items.forEach(function(e) {
        var  nickname= e.querySelector(".name").textContent.toLowerCase();
        var  name= e.querySelector(".mutual-friends").textContent.toLowerCase();

        if (nickname.includes(input) || name.includes(input)) {
            e.style.display = "flex";
        } else {
            e.style.display = "none";
        }
    });
  }
</script>