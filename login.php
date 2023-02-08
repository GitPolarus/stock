<?php require_once("./partials/header.php") ?>

<div class="text-center p-5">
    <main class="form-signin w-25 m-auto">
        <form action="./traitement.php" method="post">

            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>

        </form>
    </main>
</div>
<?php require_once("./partials/footer.php") ?>