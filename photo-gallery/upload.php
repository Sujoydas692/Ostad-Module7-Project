<?php
include 'includes/header.php';


$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];


    if (empty($title) || empty($description)) {
        $error = 'Please fill in all fields';
    } else {
        $target_dir = 'assets/images/';

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file = $image['name'];
        $new_name = uniqid() . $file;

        $target_file = $target_dir . $new_name;


        if ($image['size'] > 5000000) {
            $error = 'File size is too large. Max size is 5MB';
        } else {

            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                $sql = "INSERT INTO images (title, description, filename) VALUES (:title, :description, :filename)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':title' => $title,
                    ':description' => $description,
                    ':filename' => $new_name
                ]);

                $success = "Image uploaded successfully";
                $title = "";
                $description = "";
            } else {
                $error = "Error uploading image";
            }
        }
    }
}


?>

<div class="my-4">

</div>



<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <h1 class="text-center">Upload Photo</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" name="description"> </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php
include 'includes/footer.php';
?>