 <footer class="container-fluid">
        
        <div id="social-icons" class="row">
            <div id="footer-logo">
                <a href="index.php"><img src="assets/images/footer/logo.png"></a>
            </div>
            <div id="footer-facebook">
                <a href="https://www.facebook.com/theclubofoddvolumes" target="_blank"><img src="assets/images/footer/facebook.png"></a>
            </div>
            <div id="footer-instagram">
                <a href="https://instagram.com/theclubofoddvolumes" target="_blank"><img src="assets/images/footer/instagram.png"></a>
            </div>
        </div>
        
            <nav id="footer">
                <ul>
                    <li><a href="contact.php">CONTACT</a></li>
                    <li class="divider">/</li>
                    <li><a href="sizing.php">SIZING</a></li>
                    <li class="divider">/</li>
                    <li><a href="sizing.php#refunds">RETURNS</a></li>
                    <li class="divider">/</li>
                    <li><a href="faq.php">FAQ</a></li>
                    <li class="divider">/</li>
                    <li><a href="join-the-odd-collective.php">JOIN THE ODD COLLECTIVE</a></li>
                    <li class="divider">/</li>
                    <li><a href="artist-directory.php">ARTIST DIRECTORY</a></li>
                    <li class="divider">/</li>
                    <li><a href="privacy">PRIVACY</a></li>
                    <li class="divider">///</li>
                    <li><a href="custom-printing-bulk-pricing.php">CUSTOM PRINTING  BULK PRICING</a></li>
                    <li class="divider">/</li>
                    <li><a href="file-set-up-tips.php">FILE SET UP TIPS</a></li>
                    <li class="divider">/</li>
                    <li><a href="reseller-login.php">RESELLER LOGIN</a></li>
                    
                   
                </ul>
            </nav>
    
    </footer>



<script src="js/jquery-1.11.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>  
<script src="js/project-functions.js"></script>  


 <!-- Page Specific Scripts -->
    <?php 

        if(isset($scripts)){
        foreach ($scripts as $value){

            echo "<script src='js/{$value}.js'></script>";

        }}
    ?>
    
    
</body>
</html>
