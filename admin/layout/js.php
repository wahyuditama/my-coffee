<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<!-- include summernote css/js -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>


<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
    function printElement(elementId) {
        // Ambil elemen berdasarkan ID
        const printContent = document.getElementById(elementId);
        const originalContent = document.body.innerHTML;

        // Ganti konten body dengan elemen yang ingin dicetak
        document.body.innerHTML = printContent.outerHTML;

        // Cetak halaman
        window.print();

        // Kembalikan konten body seperti semula
        document.body.innerHTML = originalContent;

        // Reload halaman untuk memulihkan event listener (jika ada)
        window.location.reload();
    }
</script>