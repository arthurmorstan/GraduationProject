<footer>
    <div class="container-xl">
        <div class="footer-inner">
            <div class="row d-flex align-items-center gy-4">
                <div class="col-md-4">
                    <span class="copyright">&copy; 2024 G37 General Hospital</span>
                </div>
                <div class="col-md-4 text-center">
                    <ul class="social-icons list-unstyled list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-itunes"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <a href="#" id="return-to-top" class="float-md-end">
                        <i class="icon-arrow-up"></i>
                        Back to Top
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Javascript -->
<script src="Javascript/bootstrap.min.js"></script>
<script src="Javascript/jquery.min.js"></script>
<script src="Javascript/jquery.sticky-sidebar.min.js"></script>
<script src="Javascript/popper.min.js"></script>
<script src="Javascript/slick.min.js"></script>
<script src="Javascript/jquery.main.js"></script>

<!-- Vendor JS Files -->
<script src="./assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/chart.js/chart.umd.js"></script>
<script src="./assets/vendor/echarts/echarts.min.js"></script>
<script src="./assets/vendor/quill/quill.min.js"></script>
<script src="./assets/vendor/simple-datatables/simple-datatables.js"></script>
<!-- <script src="./assets/vendor/tinymce/tinymce.min.js"></script> -->
<script src="./assets/vendor/php-email-form/validate.js"></script>


<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>
<script src="main.js"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    function sendEmail() {
        Email.send({
            Host: "smtp.gmail.com",
            Username: "nguyenhoangduy40@gmail.com",
            Password: "D1690DA5751D55A5D2B1790682EE1E181FEA",
            To: 'nguyenhoangduy40@gmail.com',
            From: document.getElementById("email").value,
            Subject: "Ý kiến từ người dùng bệnh viện đa khoa G37",
            Body: "And this is the body"
        }).then(
            message => alert(message)
        );
    }
</script>
</body>

</html>