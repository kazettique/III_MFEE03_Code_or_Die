<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    
        <a class="navbar-brand" href="#">活動</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item <?= $page_name=='index' ? 'active' : '' ?>">
                    <a class="nav-link" href="index_.php">Home<span class="sr-only">(current)</span></a>
                </li> -->
                <li class="nav-item <?= $page_name=='event_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="event_list.php">活動列表</a>
                </li>
                <li class="nav-item <?= $page_name=='event_insert' ? 'active' : '' ?>">
                    <a class="nav-link" href="event_insert.php">新增活動</a>
                </li>
                <li class="nav-item <?= $page_name=='event_list2' ? 'active' : '' ?>">
                    <a class="nav-link" href="event_list2.php">成員列表</a>
                </li>
                <li class="nav-item <?= $page_name=='event_insert2' ? 'active' : '' ?>">
                    <a class="nav-link" href="event_insert2.php">報名活動</a>
                </li>
            </ul>

        </div>
     
    </div>
</nav>
