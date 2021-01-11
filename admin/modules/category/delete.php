<?php 
$open = 'category';
    require_once __DIR__. "/../../autoload/autoload.php" ; 

    $id = intval(getInput('id'));

    $editCategory = $db->fetchID('categories',$id) ;

    if (empty($editCategory)) {
        $_SESSION['error_message'] = 'Has not any category!';
        redirectAdmin('category');
    }

    $num = $db->delete('categories',$id);
    if ($num > 0) {
        $_SESSION['success_message'] = $editCategory['name'].' category has been deleted successfully!';
        redirectAdmin('category');
    }else {
        $_SESSION['error_message'] = 'Has not any change!';
        redirectAdmin('category');
    }
?>