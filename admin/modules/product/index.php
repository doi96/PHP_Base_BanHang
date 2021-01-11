
<?php
    $open = 'product';
    require_once __DIR__. "/../../autoload/autoload.php" ; 
    $products = $db->fetchAll('products');
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo modules('product') ?>">Product</a></li>
            </ol>
            </nav>
        </div>
    </div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a class="btn btn-success" href="add.php">Add Product</a>
        </div>
        <div class="clearfix">
            <!-- Session message -->
            <?php require_once __DIR__."/../../../partials/notification.php"; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Num.</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Feature</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ;foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $product['name'] ?></td>
                                <td><?php echo $product['slug'] ?></td>
                                <td>
                                    <?php if ($product['feature_item']== '1'): ?> 
                                        <span style="color: green;">Yes</span>
                                    <?php else: ?>
                                        <span style="color: red;">No</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($product['status']== '1'): ?> 
                                        <span style="color: green;">Active</span>
                                    <?php else: ?>
                                        <span style="color: red;">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $product['created_at'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-success">Edit</a>
                                    <a href="delete.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                                <?php $i++; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>
   