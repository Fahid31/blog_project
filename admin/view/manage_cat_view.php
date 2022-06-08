<?php
$catdata= $obj->display_category();
if(isset($_GET['status']))
if($_GET['status']=='delete'){
    $delid= $_GET ['id'];
    $msg=$obj->delete_category($delid);
} 

?>
<?php
if(!empty($catdata)) { ?>
<?php } ?>

<h2> Manage Category Page </h2>
<?php if(isset($msg)){
    echo $msg;
} ?>
<table class="Table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Category Description</th>
            <th>action</th>
    </tr>
</thead>
<tbody>
   <?php while($cat=mysqli_fetch_assoc($catdata)){ ?>
        <tr>
        <td><?php echo $cat['cat_id']; ?></td>
        <td><?php echo $cat['cat_name']; ?></td>
        <td><?php echo $cat['cat_des']; ?></td>
        <td>
        
            <a class="btn btn-danger" href="?status=delete&&id=<?php echo $cat['cat_id']; ?>">Delete</a>
        </td>
</tr>
<?php } ?>
    </tbody>
</table>
