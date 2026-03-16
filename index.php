<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <?php
    session_start();
    ?>
    <?php 
    include('config.php');
    include('modules/header.php');
    ?>
    <main>
        <div class="main">
            <?php 
                include('modules/product.php');
            ?>

        </div>
    </main>
   <?php 
    include('modules/footer.php');
    ?>

<script>
const input = document.getElementById("search-input");
const resultBox = document.getElementById("search-result");

/* live search */
input.addEventListener("input", function(){

    let keyword = this.value.trim();

    if(keyword.length == 0){
        resultBox.innerHTML = "";
        resultBox.style.display = "none";
        return;
    }

    fetch("/THAYTRINH/modules/search.php?key=" + keyword)
    .then(res => res.text())
    .then(data => {

        resultBox.innerHTML = data;
        resultBox.style.display = "block";

    });

});

/* click ra ngoài thì ẩn */
document.addEventListener("click", function(e){

    if(!e.target.closest(".menu-search")){
        resultBox.style.display = "none";
    }

});

/* click lại input thì hiện */
input.addEventListener("focus", function(){

    if(this.value.trim().length > 0){
        resultBox.style.display = "block";
    }

});
</script>
</body>
</html>