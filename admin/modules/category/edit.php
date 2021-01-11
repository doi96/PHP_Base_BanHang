
<?php
    $open = 'category';
    require_once __DIR__. "/../../autoload/autoload.php" ; 

    $id = intval(getInput('id'));

    $editCategory = $db->fetchID('categories',$id) ;

    if (empty($editCategory)) {
        $_SESSION['error_message'] = 'Has not any category!';
        redirectAdmin('category');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $data = [
            'name' => postInput('name'),
            'slug' => to_slug(postInput('name')),
            'feature_item' => postInput('feature'),
            'status' => postInput('status')
        ];

        $error = [];

        if (postInput('name') == '') {
            $error['name'] = 'Please enter name of category!' ;
        }

        if (empty($error)) {
            if ($editCategory['name'] != $data['name']) {

                $isset = $db->fetchOne("categories","name = '".$data['name']."' ");
                if (count($isset) > 0) {
                    $_SESSION['error_message'] =  $data['name'].' category is exists!';
                }else{
                    $id_update = $db->update('categories',$data, array('id'=>$id));
                
                    if ($id_update > 0) {
                        $_SESSION['success_message'] = 'Category has been updated successfully!';
                        redirectAdmin('category');
                    }else {
                        $_SESSION['error_message'] = 'Has not any change!';
                        redirectAdmin('category');
                    }
                }
            }else{
                $id_update = $db->update('categories',$data, array('id'=>$id));
                
                if ($id_update > 0) {
                    $_SESSION['success_message'] = 'Category has been updated successfully!';
                    redirectAdmin('category');
                }else {
                    $_SESSION['error_message'] = 'Has not any change!';
                    redirectAdmin('category');
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
                <li class="breadcrumb-item"><a href="<?php echo modules('category') ?>">Category</a></li>
                <li class="breadcrumb-item"><a href="#">Edit Category</a></li>
            </ol>
            </nav>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="card">
        <div class="card-header">
            Edit Category
        </div>
        <div class="clearfix">
            <!-- Session message -->
            <?php require_once __DIR__."/../../../partials/notification.php"; ?>
        </div>
        <div class="card-body">
        <form action="" method="POST" class="form-horizontal">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-5">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $editCategory['name'] ?>">
                <?php if(isset($error['name'])): ?>
                    <p class="text-danger"><?php echo $error['name']; ?></p>
                <?php endif ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Feature</div>
                <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="feature" name="feature" value="1" <?php if($editCategory['feature_item']=='1'){echo 'checked';} ?>>
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
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" <?php if($editCategory['status']=='1'){echo 'checked';} ?> >
                    <label class="form-check-label" for="status">
                    Active
                    </label>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>
   