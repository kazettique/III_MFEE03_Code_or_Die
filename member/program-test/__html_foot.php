</div>
        </div>
    </div>
    <script>      
        $('.sidebar-right').click(function(){
            $('.sidebar').toggleClass('off')
            $('.sidebar-left').removeClass('display-none');
            $(this).addClass('display-none');
        });
        $('.sidebar-left').click(function(){
            $('.sidebar').toggleClass('off')
            $('.sidebar-right').removeClass('display-none');
            $(this).addClass('display-none');
        })
        $('.sidebar-menu').click(function () {
            event.stopPropagation();
            $(this).toggleClass('active')
            $('.sidebar').toggleClass('offv')
            $('.sidebar-wrap').toggleClass('offv')
        })
    </script>
</body>
</html>