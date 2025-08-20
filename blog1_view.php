
<?php include('../templates/header.php'); ?>
<br>

<?php
    include "blog1_logic.php";
// choose visitor language, e.g. en | fi | fr | ru


define('SITE_ROOT', dirname(__DIR__));          // /home/users/.../raikkulenz.kapsi.fi
define('I18N_PATH', SITE_ROOT . '/language_json/');

$strings = json_decode(
    file_get_contents(I18N_PATH . 'languages_Blog.json'),
    true
);

function t1(string $id): string
{
    global $strings, $lang;
    return htmlspecialchars($strings[$lang][$id] ?? '', ENT_QUOTES, 'UTF-8');
}




?>

   <div class="container mt-5">

        <?php foreach($query as $q){?>
            <div class="bg-dark p-5 rounded-lg text-white text-center">
                <h1><?php echo $q['title'];?></h1>

                <div class="d-flex mt-2 justify-content-center align-items-center">
                    <a href="blog/blog1_edit.php?id=<?php echo $q['id']?>" class="btn btn-light btn-sm" name="edit"><?= t1('BLOG6') ?></a>
                    <form method="POST">
                        <input type="text" hidden value='<?php echo $q['id']?>' name="id">

                        <button class="btn btn-danger btn-sm ml-2" name="delete"><?= t1('BLOG8') ?></button>    
                    </form>
                </div>

            </div>
            <p class="mt-5 border-left border-dark pl-3"><?php echo $q['content'];?></p>
        <?php } ?>    

        <a href="blog1_index.php" class="btn btn-outline-dark my-3"><?= t1('BLOG7') ?></a>
   </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


<?php include('../templates/footer.php'); ?>