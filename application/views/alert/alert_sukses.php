<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sales</h1>
                 </div>
                 <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sales</li>
                    </ol>
                 </div>
            </div>
        </div>
    </div>
                <div class="alert alert-success">
                    <strong>Transaksi Berhasil</strong>
                    <a class="btn btn-danger" href="<?php echo base_url().'index.php/sales'?>"><span class="fa fa-backward"></span>Kembali</a>
                   <a class="btn btn-info" href="<?php echo base_url().'index.php/sales/cetak_struck'?>" target="_blank"><span class="fa fa-print"></span>Cetak</a>
                </div>

    </div>

    <?php $this->load->view('template/footer'); ?>

    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/moment.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'?>"></script>
    

<script type="text/javascript">
    function myFunction() {
        window.print();
    }

    function PrintDoc() {
        var toPrint = document.getElementByID('tabel');
        var popupWin = window.open('');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Print Data::</title><link rel="stylesheet" type="text/css" href="print.css" /><body onload="window.print()">')
        popupWin.document.write(toPrint.outerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }

    function PrintPreview() {
        var toPrint = document.getElementByID('tabel');
        var popupWin = window.open('');
        popupWin.document.open();
        popupWin.document.write('<html><title>::PrintPreview Data::</title><link rel="stylesheet" type="styleshee" type="text/css" href="print.css" media="screen"/> </head><body">')
        popupWin.document.write(toPrint.outerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }
</script>
    
</body>

</html>
