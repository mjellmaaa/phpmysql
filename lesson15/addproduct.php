<?php include("header.php"); ?>

<div class="signup">
    <form class="form-signin" action="products.php" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">add a product</h1>

        <label for="inputTitle" class="sr-only">title</label>
        <input type="text" id="inputTitle" class="form-control" placeholder="Title" name="title" required autofocus>
 
        <label for="inputDescription" class="sr-only">description</label>
        <input type="text" id="inputDescription" class="form-control" placeholder="Description" name="description" required autofocus>

        <label for="inputQuantity" class="sr-only">quantity</label>
        <input type="number" id="inputQuantity" class="form-control" plasceholder="Quantity" name="quantity" required autofocus >

        <label for="inputPrice" class="sr-only">price</label>
        <input type="number" id="inputPrice" class="form-control" placeholder="Price" required autofocus>

        <button class="btn btn-lg btn-primary btn-block" type="submit">add product</button>

        <p class="mt-5 mb-3 text-muted" >digital school &copy; 2026</p>
    </form>
</div>
<?php include("footer.php");?>