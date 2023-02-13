<?php require_once("./partials/header.php");
if (!$logged) {
    header("location:./login.php");
}

$updating = isset($_REQUEST["updateId"]);


require_once("./connexion.php");

// Select all the product to fill the table
$sql = "SELECT p.*, u.nom  from produits p, users u WHERE p.user_id = u.id;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Select one product to fill the form
if ($updating) {
    $updateSql = "SELECT *  from produits  WHERE id = :id;";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute(["id" => $_REQUEST["updateId"]]);
    $produit = $updateStmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET["search"])) {
    $search = htmlspecialchars($_GET['search']);
    $sql = "SELECT p.*, u.nom  from produits p, users u WHERE p.user_id = u.id  AND 
    (p.description  LIKE :description OR p.libelle LIKE :libelle);";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["description" => "%$search%", "libelle" => "%$search%"]);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<div class="text-center p-5">




    <main class="container">
        <div class="row">
            <div class="col-3">
                <?php if (!$updating): ?>

                    <form method="post" action="./traitementProduit.php">

                        <h1 class="h3 mb-3 fw-normal">Create New Product</h1>
                        <div class="form-floating mb-3">
                            <input type="text" name="libelle" class="form-control" id="label"
                                placeholder="name@example.com">
                            <label for="label">Label</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" id="description"
                                placeholder="name@example.com"></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="pu" class="form-control" id="floatingpu" placeholder="pu">
                            <label for="floatingpu">Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="qte" class="form-control" id="floatingqte" placeholder="qte">
                            <label for="floatingqte">Quantity</label>
                        </div>


                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="newProduct">Save</button>

                    </form>

                <?php else: ?>
                    <form method="post" action="./traitementProduit.php">

                        <h1 class="h3 mb-3 fw-normal">Update Product</h1>
                        <input type="hidden" name="id" value="<?= $produit["id"] ?>">
                        <div class="form-floating mb-3">
                            <input type="text" name="libelle" class="form-control" id="label"
                                value="<?= $produit["libelle"] ?>" placeholder="name@example.com">
                            <label for="label">Label</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" id="description"
                                placeholder="name@example.com"><?= $produit["description"] ?></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="pu" class="form-control" id="floatingpu" placeholder="pu"
                                value="<?= $produit["prix_unitaire"] ?>">
                            <label for="floatingpu">Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="qte" class="form-control" id="floatingqte" placeholder="qte"
                                value="<?= $produit["quantite"] ?>">
                            <label for="floatingqte">Quantity</label>
                        </div>


                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="updateProduct">Update</button>

                    </form>
                <?php endif; ?>

            </div>
            <div class="col-9">
                <div class="d-flex justify-between align-items-center mb-4">
                    <h2 class="text-danger text-uppercase">Product List</h2>

                    <form method="get" class="w-50 ms-auto">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" name="search" placeholder="Search"
                                aria-label="search" />
                            <button class="btn btn-secondary"> <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <?php if (count($produits) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produits as $p): ?>
                                    <tr>
                                        <td>
                                            <?= $p["id"] ?>
                                        </td>
                                        <td>
                                            <?= $p["libelle"] ?>
                                        </td>
                                        <td>
                                            <?= $p["description"] ?>
                                        </td>
                                        <td>
                                            <?= $p["prix_unitaire"] ?>
                                        </td>
                                        <td>
                                            <?= $p["quantite"] ?>
                                        </td>
                                        <td>
                                            <?= $p["nom"] ?>
                                        </td>

                                        <td>
                                            <a href="./produits.php?updateId=<?= $p["id"] ?>" class="btn btn-sm btn-info"
                                                title="Modify"> <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="./traitementProduit.php?deleteId=<?= $p["id"] ?>"
                                                class="btn btn-sm btn-danger" title="Delete"> <i class="bi bi-trash"></i>
                                            </a>
                                        </td>

                                    </tr>


                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">Nothing Found</div>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <!-- write the code -->
    <?php require_once("./partials/footer.php") ?>