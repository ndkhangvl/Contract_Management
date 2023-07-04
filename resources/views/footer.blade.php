<footer>
    <div id="footerCus" class="text-center text-white p-3 footer" style="background-color: #077DCE; bottom: 0; ">
        © 2023 Copyright:
        <a class="text-white text-decoration-none" href="https://cit.ctu.edu.vn"> CICT</a>
    </div>
    <script>
        function updateFooterMargin() {
            var w = window.innerWidth;
            if (w < 1200) {
                document.getElementById('footerCus').style.marginLeft = '0';
            } else {
                document.getElementById('footerCus').style.marginLeft = '300px';
            }
        };

        window.addEventListener('DOMContentLoaded', (event) => {
            updateFooterMargin();
        });

        window.addEventListener('resize', (event) => {
            updateFooterMargin();
        });
    </script>
</footer>
