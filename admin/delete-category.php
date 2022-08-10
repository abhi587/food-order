<?php 

    //include constants file
    include('../config/constants.php');


    //echo "Delete Page";
    //check whether the id and image-name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "GET the value and delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the phicisal image file if available
        if($image_name != "")
        {
            //image is available,so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove= unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'> Failed to remove Category Image.</div>";
                
                //redirect To manage-category page
                header('location:'.SITEURL. 'admin/manage-category.php');

                //stop the process
                die();
            }
        }

        //delete data from database
        //sql query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res= mysqli_query($conn, $sql);

        //check whether thw data is deleted from data or not
        if($res==true)
        {
            //set success message and redirect.
            $_SESSION['delete']="<div class='success'>Category deleted sucessfully</div>";
            //redirect to manage-category
            header('location:'.SITEURL. 'admin/manage-category.php');
        }
        else
        {
            //set fail message and rediect
            $_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";
            //redirect to manage-category
            header('location:'.SITEURL. 'admin/manage-category.php');
        }

        
    }
    else
    {
        //redirect to manage-category page
        header('location:'.SITEURL. 'admin/manage-category.php');
    }
?>