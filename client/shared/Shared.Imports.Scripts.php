<!-- JS Libraries -->
<script src="/shared/extras/jquery/jquery-3.6.0.min.js"></script>
<script src="/client/shared/template_files/js/bootstrap.bundle.min.js"></script>
<script src="/client/shared/template_files/lib/easing/easing.min.js"></script>
<script src="/client/shared/template_files/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template JavaScript -->
<script src="/client/shared/template_files/js/main.js"></script>

<!-- Extracted from [./template_files/mail/contact.js] to make tabs work again, since the rest of the contents in it won't be used (not for now at least). -->
<script>
    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
</script>