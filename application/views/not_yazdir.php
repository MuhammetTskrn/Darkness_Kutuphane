<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Satış Faturası</title>
    <style>
        body {
            font-family: arial;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info-table {
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 5px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .items-table th {
            background-color: #f5f5f5;
        }
        .total-row td {
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Satış Faturası</h2>
    </div>
    
    <table class="info-table">
        <tr>
            <td>İşlem No</td>
            <td>: <?=$transaction->transaction_code?></td>
        </tr>
        <tr>
            <td>Kasiyer</td>
            <td>: <?=$transaction->fullname?></td>
        </tr>
        <tr>
            <td>Müşteri</td>
            <td>: <?=$transaction->buyer_name?></td>
        </tr>
        <tr>
            <td>Tarih</td>
            <td>: <?=$transaction->tgl?></td>
        </tr>
    </table>

    <table class="items-table">
        <tr>
            <th class="text-center">No</th>
            <th>Başlık</th>
            <th class="text-right">Fiyat</th>
            <th class="text-center">Adet</th>
            <th class="text-right">Ara Toplam</th>
        </tr>
        <?php $no=0; foreach ($this->trans->detail_transaction($transaction->transaction_code) as $book): $no++; ?>
        <tr>
            <td class="text-center"><?=$no?></td>
            <td><?=$book->book_title?></td>
            <td class="text-right"><?=number_format($book->price)?> ₺</td>
            <td class="text-center"><?=$book->amount?></td>
            <td class="text-right"><?=number_format(($book->price*$book->amount))?> ₺</td>
        </tr>
        <?php endforeach ?>
        <tr class="total-row">
            <td colspan="4" class="text-right">Toplam Tutar</td>
            <td class="text-right"><?=number_format($transaction->total)?> ₺</td>
        </tr>
    </table>

    <script>
        window.print();
        setTimeout(() => {
            location.href="<?=base_url('index.php/transaction/clearcart')?>";
        }, 2500);
    </script>
</body>
</html>