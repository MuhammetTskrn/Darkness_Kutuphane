<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura #<?=$nota->transaction_code?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details table {
            width: 100%;
        }
        .details td {
            padding: 5px;
        }
        .items {
            margin-bottom: 30px;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items th, .items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .items th {
            background-color: #f5f5f5;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FATURA</h1>
            <h3>Fatura No: #<?=$nota->transaction_code?></h3>
            <p>Tarih: <?=$nota->tgl?></p>
        </div>

        <div class="details">
            <table>
                <tr>
                    <td><strong>Müşteri Adı:</strong></td>
                    <td><?=$nota->buyer_name?></td>
                    <td><strong>Kasiyer:</strong></td>
                    <td><?=$nota->fullname?></td>
                </tr>
            </table>
        </div>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kitap Adı</th>
                        <th>Adet</th>
                        <th>Fiyat</th>
                        <th>Ara Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($detail_transaction as $detail): 
                        $subtotal = $detail->amount * $detail->price;
                    ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$detail->book_title?></td>
                        <td><?=$detail->amount?></td>
                        <td class="text-right"><?=number_format($detail->price)?> ₺</td>
                        <td class="text-right"><?=number_format($subtotal)?> ₺</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="total">Toplam Tutar:</td>
                        <td class="total"><?=number_format($nota->total)?> ₺</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="no-print" style="text-align: center; margin-top: 30px;">
            <button onclick="window.print()">Yazdır</button>
            <a href="<?=base_url('index.php/islem/index')?>"><button>Geri Dön</button></a>
        </div>
    </div>
</body>
</html>
