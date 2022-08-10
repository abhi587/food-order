<?php  include('partials/menu.php'); ?>



<div class ="main-content">
    <div class="wrapper">

        <h1>Add Admin</h1>

        <br /><br />

        <?php 
            if(isset($_SESSION['add']))  // checking whether the session is checked or not
            {
                echo $_SESSION['add']; // display session message is set
                unset($_SESSION['add']); // remove session message
            }
        ?>


        <form action="" method="POST">

            <table class="tbl-30">

            <tr>
                <td>Full Name</td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name"> </td>
            </tr>

            <tr>
                <td>UserName</td>
                <td>
                    <input type="text" name="username" placeholder="Your UserName">
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="Your Password">
                </td>
            </tr>


            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>

            </table>

        </form>

    </div>  
</div>

<?php include('partials/footer.php'); ?>




<?php 
    //process the value from form and save it in Database

    //Check whether the button is clicked or not

    if(isset($_POST['submit']))
    {
        //botton clicked
       //echo "Button Clicked";

        //get data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);  //password encryption with md5



        //2. sql Query to save the data into database
        $sql= "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";


        //3.Executing query and saving data into database.
        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //4.check whether the (Query is executed) data is incerted or not and display appropiate message
        if($res==TRUE)
        {
            //Data inserted
            //echo "Data inserted";
            //create a session variable to display a message
            $_SESSION['add']="<div class = 'success'>Admin Added Successfully</div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to insert data
            //echo "Failed to insert data";
            //create a session variable to display a message
            $_SESSION['add']="<div class = 'error'>Failed To Add Admin</div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');

        }

    }
    
?>