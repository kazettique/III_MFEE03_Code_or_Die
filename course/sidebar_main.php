<style>
#wrapper {
  padding-left: 250px;
  transition: all 0.4s ease 0s;
}

#sidebar-wrapper {
  margin-left: -250px;
  left: 250px;
  width: 180px;
  background: #000;
  position: fixed;
  height: 100%;
  overflow-y: auto;
  z-index: 1000;
  transition: all 0.4s ease 0s;
}

#wrapper.active {
  padding-left: 0;
}

#wrapper.active #sidebar-wrapper {
  left: 0;
}

#page-content-wrapper {
  width: 100%;
}

.sidebar-nav {
  position: absolute;
  top: 0;
  list-style: none;
  margin: 0;
  padding: 0;
}

.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}

.sidebar-nav li a {
  color: #999999;
  display: block;
  text-decoration: none;
  font-size: 20px;
}

.sidebar-nav li a span:before {
  position: absolute;
  left: 0;
  color: #41484c;
  text-align: center;
  width: 20px;
  line-height: 18px;
}

.sidebar-nav li a:hover,
.sidebar-nav li.active {
  color: #fff;
  background: rgba(255,255,255,0.2);
  text-decoration: none
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 65px;
  line-height: 60px;
  font-size: 18px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: none;
}


@media (max-width:767px) {

#wrapper {
  padding-left: 0;
}

#sidebar-wrapper {
  left: 0;
}

#wrapper.active {
  position: relative;
  left: 250px;
}

#wrapper.active #sidebar-wrapper {
  left: 250px;
  width: 250px;
  transition: all 0.4s ease 0s;
}

}
</style>


<!-- Sidebar -->
<div id="sidebar-wrapper">
    <nav id="spy">
        <ul class="sidebar-nav nav">
            <li class="sidebar-brand">
                <a href="#home"><span class="fa fa-home solo">Home</span></a>
            </li>
            <li>
                <a href="#anch1" data-scroll>
                    <span class="">會員帳號管理</span>
                </a>
            </li>
            <li>
                <a href="#anch2" data-scroll>
                    <span class="">賣家管理</span>
                </a>
            </li>
            <li>
                <a href="event_list.php" data-scroll>
                    <span class="">活動管理</span>
                </a>
            </li>
            <li>
                <a href="#anch4" data-scroll>
                    <span class="">發文系統管理</span>
                </a>
            </li>
            <li>
                <a href="#anch4" data-scroll>
                    <span class="">路線規畫管理</span>
                </a>
            </li>
            <li>
                <a href="#anch4" data-scroll>
                    <span class="">課程集資管理</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
