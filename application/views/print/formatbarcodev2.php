<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Export Barcode</title>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200&display=swap" rel="stylesheet" />
  <style>
    @page {
      size: 33.87mm 18.78mm;
      margin: 0;
    }
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Source Sans 3', sans-serif;
    }

    .header-black {
        background-color: black !important;
        color: white !important;
    }

    table {
      width: 100%;
      height: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 1px 2px;
      box-sizing: border-box;
      text-align: center;
      vertical-align: middle;
    }

    h6 {
      margin: 0;
      font-size: 6pt;
      font-weight: 600;
      text-transform: uppercase;
      word-wrap: break-word;
    }


    .barcode-img {
      width: 100%;
      height: 34px;
      object-fit: contain;
    }

    .barcode-label {
      font-size: 6pt;
      word-break: break-word;
    }

    .bordered {
      border: 1px solid black;
    }
.footer-bar {
  background-color: black;
  color: white;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 4px;
  font-size: 4pt;
  font-weight: bold;
}

.footer-content span {
  width: 50%;
}

.footer-content .left {
  text-align: left;
}

.footer-content .right {
  text-align: right;
}


  </style>
      <script>
        window.onafterprint = window.close;
        window.print();
  </script>
</head>
<body>
  <table>
<?php foreach ($products as $product): ?>
  <?php if ($product['jenis'] !== 'AKSESORIS'): ?>
    <!-- Original layout for non-accessory -->
<!-- Flex layout for non-AKSESORIS -->
<div style="width: 100%; height: 18.78mm; display: flex; flex-direction: column; justify-content: space-between; box-sizing: border-box; padding: 0;">

  <!-- Header -->
  <div class="header-black" style="display: flex; justify-content: space-between; padding: 0 4px; font-size: 4pt; font-weight: bold;">
    <div><?= $product['jenis']; ?></div>
    <div><?= $product['kondisi'] === 'Bekas' ? 'SECOND' : 'NEW'; ?></div>
    <div><?= date('d/m/Y', strtotime($product['tgl_keluar'])); ?></div>
  </div>

  <!-- Product name -->
  <div style="text-align: left; font-size: 6pt; line-height: 1; padding: 3px; font-weight: bold;">
    <?= $product['nama_brg']; ?>
  </div>

  <!-- Barcode -->
  <div style="text-align: center;">
    <img class="barcode-img" src="<?= base_url() ?>assets/dhdokumen/snbarcode/<?= $product['sn_brg']; ?>.jpg" alt="Barcode" />
  </div>

</div>


  <?php else: ?>
    <!-- Fixed-height flex layout for AKSESORIS -->
    <div style="width: 100%; height: 18.78mm; display: flex; flex-direction: column; justify-content: space-between; box-sizing: border-box; padding: 0;">
      
      <!-- Product name -->
      <div style="text-align: left; font-size: 6pt; line-height: 1; padding:3px; font-weight: bold;">
        <?= $product['nama_brg']; ?>
      </div>

      <!-- Barcode -->
      <div style="text-align: center;">
        <img class="barcode-img" src="<?= base_url() ?>assets/dhdokumen/snbarcode/<?= $product['sn_brg']; ?>.jpg" alt="Barcode" />
      </div>

      <!-- Footer always at bottom -->
      <div class="footer-bar">
        <div class="footer-content">
          <span class="left"><?= $product['jenis']; ?></span>
          <span class="right"><?= date('d/m/Y', strtotime($product['tgl_keluar'])); ?></span>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endforeach; ?>

  </table>
</body>
</html>
