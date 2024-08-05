<!DOCTYPE html>
<!doctype html>
<!--<html lang="en">-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">-->
    <link href="../css/header.css" rel="stylesheet" type="text/css"/>
    <script src="https://use.fontawesome.com/f9fd45026c.js"></script>
  </head>
<!--  <body>-->
    
    <header>
    <div class="home-nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="home.php"><img src="../Images/logo.png" alt="Sweat Lab" style="height: 50px;width: 100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home<span class="sr-only"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="productMen.php"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Our Products</a>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AboutUs.php"><i class="fa fa-building" aria-hidden="true"></i>&nbsp;Our Company</a>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userProfile.php" data-bs-toggle="modal"data-target="#staticBackdrop"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart</a>
                </li>
               
                <li>
            </ul>
            </div>

<!--            <div class="login-btn">
                <a href="../login.php" style="text-decoration: none;">Login</a>
            </div>-->
        </div>
    </nav>
    </div>
    </header>
    
      
      
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
        const myModal = document.getElementById('myModal');
        const myInput = document.getElementById('myInput');

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus();
        });
      </script>
<!--  </body>-->
<!--  </html>-->
