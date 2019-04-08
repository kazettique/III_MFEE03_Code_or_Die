<?php
     $sid = isset($_GET["sid"])? intval($_GET["sid"]) : 0;
?>
<?php include __DIR__."./header_html.php"; ?>
<?php include __DIR__.'/../_navbar.php'; ?>
<form
        name="form"
        method="post"
        action="__edit_img.php"
        onsubmit = ""
        enctype= multipart/form-data
      >
        <input type="text" name="sid" value=<?= $sid ?> style="display: none;"> 
        <input type="file" name="uploaded" id="upload">
        <button type="submit" id="submit">Submit</button>
</form>    
</body>
</html>