<style>
  nav{
    width: 100%;
    
  }
  nav ul{
    list-style: none;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    
  }
  nav li{
    width: 100px;
    height: 40px;
    display:flex;
    justify-content: center;
    align-items: center;
    border: 1px solid rgb(59, 56, 56);
    box-shadow: 2px 5px 10px black;
    margin: 10px 30px;
    
  }
  nav li a,
  nav li a:hover,
  nav li a:visited,
  nav li a:active{
    height:100%;
    width: 100%;
    text-decoration: none;
    color: black;
    display:flex;
    justify-content: center;
    align-items: center;
  }

</style>

<nav>
<ul >
  <li >
    <a href="./list.php">文章列表</a>
  </li>
  <li>
    <a href="./editor.php">發表文章</a>
  </li>
</ul>
</nav>