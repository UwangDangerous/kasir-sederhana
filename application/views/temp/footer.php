
        <!-- <script src="<?//= base_url(); ?>assets/bootstrap/js/bootstrap.js" ></script> -->
        <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.bundle.js" ></script>
        <script src="<?= base_url(); ?>assets/js/script.js" ></script>


        <!-- Initialize Quill editor -->





        <script>
            $(document).ready(function() {
                $('#tabel').dataTable();
            } );
        </script>

        <script src="<?= base_url(); ?>assets/js/jquery-chained.min.js"></script>
        


        <script>
            $("#provinsi").click(function(){
                $("#kota").chained("#provinsi");
            });
        </script>

        <script>
            tinymce.init({
                selector: '#timy' ,
                plugins: "lists,charmap,preview ",
                toolbar: 'numlist bullist bold italic underline superscript subscript align charmap preview'
            });
        </script>

        <!-- js untuk select2  -->
        <!-- <script src="<?//= base_url(); ?>assets/jsDelivr/jsDelivr_select.js"></script> -->
        <script>
            $(document).ready(function () {
                $("#flexibel").select2({
                    theme: 'bootstrap4'
                    // placeholder: "--Pilih--"
                });
            });
        </script>

    </body>
</html>