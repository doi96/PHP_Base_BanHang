
<?php
    $open = 'dashboard'; 
    require_once __DIR__. "/autoload/autoload.php" ; 
    $categories = $db->fetchAll('categories');
?>

<?php require_once __DIR__. "/layouts/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin">Home</a></li>
            </ol>
            </nav>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php require_once __DIR__. "/layouts/footer.php"; ?>
   