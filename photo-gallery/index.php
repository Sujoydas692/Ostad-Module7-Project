<?php
include 'includes/header.php';

$sql = "SELECT * FROM images ORDER BY upload_date DESC";
$stmt = $pdo->query($sql);

$images = $stmt->fetchAll();

?>


<div class="my-4">
    <h1 class="text-center">Photo Gallery</h1>
</div>

<div class="container">
    <div class="row">

        <?php
        if (count($images) > 0) {
            foreach ($images as $image) {
                ?>

                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="assets/images/<?php echo $image['filename'] ?>" class="card-img" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $image['title'] ?></h5>
                            <p class="card-text">
                                <?php echo date('l, d F g:i A', strtotime($image['upload_date'])) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <?php
            }
        } else { ?>

            <div class="alert alert-info" role="alert">
                No images found.
            </div>
        <?php } ?>

    </div>
</div>

<?php
include 'includes/footer.php';
?>