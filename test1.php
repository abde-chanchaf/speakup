<style>
      
       .time{
        font-size:15px;
        color:red;
        position:absolute;
        left: 5px;
        margin-top:5px;
       }
       .con{
        font-size:15px;
        color:red;
        position:absolute;
        right: 5px;
       }

</style>
<?php require_once '../config.php'; 

$id_am=$_GET['id_am'];
echo'<input type="hidden" id="id_am" name="id_am" value="'.$id_am.'">';
echo'<input type="hidden" id="id" name="id" value="3">
 <div class="ul" name="ul" id="ul">
 <div class="time" id="time"></div><div class="con" id="conv"></div>
 </div>';

                 $sql1="UPDATE message JOIN conversation ON message.id_cv = conversation.id_cv SET message.vue_ms = 1 WHERE conversation.id_am = $id_am;
";
                 $result1=mysqli_query($con,$sql1);
          ?>
          
          <div class="ms" id="ms">
            
          </div>
          
          <!-- <script>
  
            // var time=document.getElementById('time');
            // var con=document.getElementById('con');
            // fetch('json.php')
            
            // .then(respense => {
            //   if (!respense.ok) { 
            //     throw new ERORR('respense.status');
            //   }
            //   return respense.json();
            // })
            // .then(data=>{
            //   data.foreach(e=>{

            //      console.log(e.content);



            //   })
            // })




            async function message() {
              try{
                var respense=await fetch('json.php');
                var data=await respense.json();

                data.foreach((e)=>{
                  console.log(e.content);
                })
                
              }
              catch(e){
                console.log("error");
              }
              
            }
            message();
          </script> -->


          <script>
           var id_am=document.getElementById("id_am").value;
            var id=document.getElementById("id").value;
            var ul=document.getElementById("ul");

    async function message() {
        try {
            let response = await fetch('http://localhost/speakup/php/json.php?id_am='+id_am);
            
            if (!response.ok) {
                throw new Error(response.status);
            }
           
            let data = await response.json();
          ul.textContent="";

            document.getElementById('con').innerHTML="";
            document.getElementById('time').innerHTML="";
            
            data.forEach((e) => {
                var li=document.createElement('p');
                if (e.id_send!=id) {
                  document.getElementById('conv').innerHTML += e.time_ms;
                document.getElementById('con').innerHTML += e.content + '<br>';
                li.appendChild(con);
                }
                else{
                  document.getElementById('time').innerHTML += e.time_ms;
                document.getElementById('time').innerHTML += e.content + '<br>';
                li.appendChild(time);
                }
                ul.appendChild(li);
            });
        } catch (e) {
            console.log("error", e);
        }
    }

    setInterval(message,100);
    
</script>
          

















           
          