<!-- footer section -->
<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_detail">
                    <h4>
                        Tentang Kami
                    </h4>
                    <p>
                        Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
                    </p>

                </div>
            </div>
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Offline Store Kami
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Lokasi :
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            <span>
                                HP/WA. 0821xxxxxxxx
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                            <span>
                                IG :
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                            <span>
                                Youtube :
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 footer-col">
                <div class="map_container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27526.67500364611!2d119.48654453933393!3d-5.139787562051907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefdd01a7a1e75%3A0x8831aee4b19747ae!2sperintis%20kemerdekaan%2012!5e1!3m2!1sen!2sid!4v1726069488274!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="footer-info">
            <p>
                &copy; <span id="displayYear"></span> Copyright by ~ 2024
                <a href="#"><b>Titik Balik Teknologi - Makassar</b></a>
            </p>
        </div>
    </div>
</footer>
<!-- footer section -->

<script src="assets/frontend-ui/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="assets/frontend-ui/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="assets/frontend-ui/js/custom.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>

<script>
    // Tampilkan loading
    function showLoading() {
        document.getElementById('loading-overlay').style.display = 'flex';
    }

    // Sembunyikan loading
    function hideLoading() {
        document.getElementById('loading-overlay').style.display = 'none';
    }

    // Contoh Fetch API dengan loading
    async function fetchData(url) {
        showLoading(); // Tampilkan loading
        try {
            const response = await fetch(url);
            const data = await response.json();
            console.log(data);
        } catch (error) {
            console.error('Error fetching data:', error);
        } finally {
            hideLoading(); // Sembunyikan loading setelah selesai
        }
    }

    // Contoh penggunaan Fetch API
    document.addEventListener('DOMContentLoaded', function() {
        fetchData('https://jsonplaceholder.typicode.com/posts');
    });


    // Tampilkan loading saat link diklik
    document.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Tampilkan overlay
            showLoading();

            // Biarkan browser melakukan navigasi setelah beberapa saat
            setTimeout(function() {
                window.location.href = link.href;
            }, 500); // 500ms untuk memberikan efek loading
            e.preventDefault(); // Hentikan navigasi default sementara
        });
    });
</script>
<script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        var navbar = document.getElementById("navbar");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    }
</script>
</body>

</html>