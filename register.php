<?php require_once("./partials/header.php") ?>
<!-- write the code -->
<div class="text-center p-5">



    <main class="form-signin w-25 m-auto">
        <form method="post" action="./traitement.php">

            <h1 class="h3 mb-3 fw-normal">sign Up</h1>
            <div class="form-floating mb-3">
                <input type="name" name="name" class="form-control" id="name" placeholder="name@example.com">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>


            <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Register</button>

        </form>
    </main>
</div>
<?php
require_once("./partials/footer.php") ?>