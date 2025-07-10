<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Barcode</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200&display=swap" rel="stylesheet">
    <style>
        @page {
            size: 33.87mm 18.78mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif; /* Set the default font */
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        td {
            width: 33.87mm;
            height: 18.78mm;
            /* display: flex;
            flex-direction: row;
            justify-content: center; */
            align-items: center;
            padding: 2px;
            box-sizing: border-box;
            text-align: center;
        }

        h6 {
            margin: 0;
            font-size: 4pt;
            font-family: 'Open Sans', sans-serif; 
            font-weight: 600;
            font-style: normal;
            word-wrap: break-word;
            text-transform: uppercase;
            width: 100%;
            height: auto;
        }

        img {
            width: 122px;
            height: 34px;
            object-fit: contain;
        }
    </style>
    <!-- <script>
        window.onafterprint = window.close;
        window.print();
  	</script> -->
</head>
<body>
    <table>
        <?php foreach ($products as $product): ?>
			<?php if($product['jenis'] !== 'AKSESORIS'): ?>
				<tr style="background-color: black;">
					<td>
						<h6 style="color: white;"><?php echo $product['jenis']; ?></h6>
					</td>
					<td>
						<h6 style="color: white;"><?php echo $product['kondisi'] == 'Bekas' ? 'SECOND' : 'NEW'; ?></h6>
					</td>
					<td>
						<h6 style="color: white;"><?php echo date('d/m/Y', strtotime($product['tgl_keluar'])); ?></h6>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<h6><?php echo $product['nama_brg']; ?></h6>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<img src="<?= base_url() ?>assets/dhdokumen/snbarcode/<?php echo $product['sn_brg']; ?>.jpg" alt="Product Image">
					</td>
				</tr>
			<?php else: ?>	
				<tr>
					<td colspan="2">
						<h6><?php echo $product['nama_brg']; ?></h6>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<img src="<?= base_url() ?>assets/dhdokumen/snbarcode/<?php echo $product['sn_brg']; ?>.jpg" alt="Product Image">
					</td>
				</tr>
				<tr style="background-color: black;">
					<td>
						<h6><?php echo $product['jenis']; ?></h6>
					</td>
					<td>
						<h6><?php echo date('d/m/Y', strtotime($product['tgl_keluar'])); ?></h6>
					</td>
				</tr>				
			<?php endif; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>
