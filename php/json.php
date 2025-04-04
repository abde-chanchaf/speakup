<?php
require_once '../config.php';

        $id_am=$_GET['id_am'];

        $sql="SELECT * FROM message,conversation WHERE conversation.id_am=$id_am and message.id_cv=conversation.id_cv ";
        $result=mysqli_query($con,$sql);
        
       
        


        if ($result->num_rows >0) {
            $message=array();
            while ($row=mysqli_fetch_array($result)) {
                $message[]=$row; 
                // 
            }
            // echo json_encode($message);
            // header('location:conversation.php?id_am='.$row['id_am'].'');
        // $sql1="UPDATE `message` SET `vue_ms`=1 WHERE id_cv='$row['id_cv']'";
        //          $result1=mysqli_query($con,$sql1);
           echo json_encode( $message);
        } else {
            echo json_encode(array('message'=>'no record found.'));
        }

?>