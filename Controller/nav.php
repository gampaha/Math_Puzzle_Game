
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #24686C;">
  <div class="container">
    <a class="navbar-brand text-warning" href="#"><i class="bi bi-puzzle-fill"></i>MATH PUZZLE GAME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
      </ul>
      <form class="d-flex" role="search">
          <span class='pt-3 text-white'>
            <?php if(strlen($_SESSION['login-submit'])){
                echo htmlentities($_SESSION['login-submit']);
            } ?>
          </span>
      </form>
    </div>
  </div>
</nav>