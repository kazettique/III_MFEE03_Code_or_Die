<?php
//require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';
$page_name = 'login';

?>
<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__. '/__navbar.php';  ?>
<div class="container alert alert-info my-3 col-lg-6" role="alert">
    歡迎來到集資管理系統
</div>
<div class="card col-lg-6 bg-light">
    <div class="container">
        <?php if(! isset($_SESSION['admin'])): ?>

            <?php if(isset($msg)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $msg ?>
            </div>
        <?php endif ?>
        <form method="post">
            <div class="form-group">
                <label for="user">帳號</label>
                <input type="text" class="form-control" name="user" placeholder="帳號" value="<?= $user ?>">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" name="password" placeholder="密碼" value="<?= $password ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php else: ?>
            <script>
                location.href = './data_list.php';
            </script>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__. '/__html_foot.php';  ?>