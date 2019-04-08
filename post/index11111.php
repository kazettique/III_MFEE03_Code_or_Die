<?php include __DIR__."./header_html.php"; ?>
<style>
    .sidebar{
        width:20%;
        position:absolute;
        left:0;
        height: 100vh;
    }
    .content{
        width:80%;
        position:absolute;
        right:0;
        height: 100vh;
    }
</style>
<body>
<div class="sidebar">
<?php include __DIR__."./sidebar.php"; ?>
</div>
<div class="content">
<?php include __DIR__."./list.php"; ?>
</div>
</body>
