    
    
        </div>
        <footer class = "footer">
            <p style = "float: left" class = "footerText">© 2023 Nicolaescu Ovidiu-Constantin</p>
            <p style = "float: right" class = "footerText">All rights reserved</p>
           <a href="admin.php"> <button style = "float: right" class = "adminButton">Admin View</button></a>

           <?php if(isset($_SESSION["loggedIn"])) { ?>
            <form method="POST" action="footer.php">
                <input value="Logout" type="submit" name="logoutBtn" style = "float: right" class = "adminButton">
                <p style = "float: right" class = "footerText">Logged in as admin</p>


            </form>  
           <?php }
           if (isset($_POST['logoutBtn'])) {
            session_start();
            session_destroy();
            header('Location: home.php');
           }

           ?>

        </footer>
    </body>
</html>