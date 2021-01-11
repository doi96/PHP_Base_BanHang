
<?php
    $open = 'product';
    require_once __DIR__. "/../../autoload/autoload.php" ;
    
    $getCategorys = $db->fetchAll('categories');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $data = [
            'category_id' => postInput('category_id'),
            'name' => postInput('name'),
            'slug' => to_slug(postInput('name')),
            'feature_item' => postInput('feature'),
            'status' => postInput('status')
        ];

        $error = [];

        if (postInput('name') == '') {
            $error['name'] = 'Please enter name of product!' ;
        }
        if (postInput('category_id') == 0) {
            $error['category_id'] = 'Please choose category!' ;
        }

        if (empty($error)) {

            $isset = $db->fetchOne("products","name = '".$data['name']."' ");
            if (count($isset) > 0) {
                $_SESSION['error_message'] =  $_POST['name'].' product is exists!';
            }else {
                $id_insert = $db->insert('products',$data);
            
                if ($id_insert > 0) {
                    $_SESSION['success_message'] = $_POST['name'].' product has been added successfully!';
                    redirectAdmin('product');
                }else {
                    $_SESSION['error_message'] = 'Please try again!';
                }
            }
        }
    }
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
                <li class="breadcrumb-item"><a href="#">Add Product</a></li>
            </ol>
            </nav>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="card">
        <div class="card-header">
            Add Product
        </div>
        <div class="clearfix">
            <!-- Session message -->
            <?php require_once __DIR__."/../../../partials/notification.php"; ?>
        </div>
        <div class="card-body">
        <form action="" method="POST" class="form-horizontal">
            <div class="form-group row">
                <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-5">
                    <select id="category_id" class="form-control" name="category_id" >
                        <option selected>Select</option>
                        <?php foreach ($getCategorys as $getCategory):?>
                            <option value="<?php echo $getCategory['id'] ?>"><?php echo $getCategory['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if(isset($error['category_id'])): ?>
                        <p class="text-danger"><?php echo $error['category_id']; ?></p>
                    <?php endif ?>
                </div>
                
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-5">
                <input type="text" class="form-control" id="name" name="name">
                <?php if(isset($error['name'])): ?>
                    <p class="text-danger"><?php echo $error['name']; ?></p>
                <?php endif ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Feature</div>
                <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="feature" name="feature" value="1">
                    <label class="form-check-label" for="feature">
                    Show on Feature
                    </label>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Status</div>
                <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1">
                    <label class="form-check-label" for="status">
                    Active
                    </label>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
        
    </div>
</div>

<!-- /.container-fluid -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>
   