<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Custom Paper Size</title>
        <style>
            @page {
                size: 2in 0.4479in; /* Custom size: 2 inches by 0.4479 inches */
                margin: 0;          /* Set margin to 0 to avoid any default margins */
            }

            body {
                margin: 0;
                padding: 0;
            }

            .content {
                width: 192px;
                height: 43px;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                border: 1px solid black; /* Optional: for visual reference */
            }

            table, th, td {
                border: none;
                border-collapse: collapse;
            }
            h6 {
                text-align:center;
                margin-top:2px;
                font-size: 4px;
            }
            img {
                margin-top:-20px;
                margin-left: 4px;
                width: 84px;
                height: 21px;
            }
        </style>
    </head>
    <body>
        <table>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($products as $index => $product): ?>
                    <?php if ($index % 2 == 0): ?>
                        <tr>
                    <?php endif; ?>
                    <td class="product-cell">
                        <h6><?php echo $product['nama_brg']; ?></h6>
                        <img src="<?= base_url() ?>assets/dhdokumen/snbarcode/<?php echo $product['sn_brg']; ?>.jpg" alt="Product Image">
                    </td>
                    <?php if ($index % 2 == 1 || $index == count($products) - 1): ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
        </table>
    </body>
</html>
