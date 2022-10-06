<?= $this->include('template/header') ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<!-- Start Content-->
<div class="container-fluid" id="content_principal">
    <?= $this->include('pages/dash') ?>
    <?= $this->include('pages/libro') ?>
    <?= $this->include('pages/estudiante') ?>
    <?= $this->include('pages/entrega') ?>
    <?= $this->include('pages/venta') ?>
</div> <!-- container -->

<?= $this->include('template/footer') ?>