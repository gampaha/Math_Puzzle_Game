<nav class="navbar navbar-expand-md navbar-light bg-light">

<h2 style="font-size:12px;color: black;color: #160219f5 !important;">
    Welcome 
    <?php if(strlen($_SESSION['login-submit']))
    {   ?>
    <?php echo htmlentities($_SESSION['login-submit']);?></a>
    </li>
    <?php 
    } ?> 
    </h2> 
    </nav>