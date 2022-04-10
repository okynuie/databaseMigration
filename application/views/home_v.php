<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
  <title>MIGRASI</title>
</head>

<body>
  <div>
    <h1>Migrasi Database</h1>
  </div>

  <div id="form">
    <form id="thisForm" action="Home/importDB" method="POST">
      <div class="container">
        <div class="item-container">
          <h2>Database lama</h2>
          <select name="databases1" id="databases1">
            <option value="0">Pilih</option>
            <?php foreach ($dbs as $db) : ?>
              <option value="<?= $db; ?>"><?= $db; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="item-container">
          <h2>Database baru</h2>
          <select name="databases2" id="databases2" onchange="pilihTabel()">
            <option value="0">Pilih</option>
            <?php foreach ($dbs as $db) : ?>
              <option value="<?= $db; ?>"><?= $db; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="item-container">
          <h2>Table lama</h2>
          <div id="atribut">
            <select name="tables1" id="tables1">
              <option value='0'>Pilih</option>
            </select>
            <span>
              <button type="button" onclick="showData()">?</button>
            </span>
          </div>
        </div>
        <div class="item-container">
          <h2>Table baru</h2>
          <select name="tables2" id="tables2" onchange="pilihAttr()">
            <option value='0'>Pilih</option>
          </select>
        </div>

        <div class="item-container">
          <h2>Attribute lama</h2>
          <div id="table-lama">
            <div id="tb1">
            </div>
            <div id="tipe-data">

            </div>
          </div>
        </div>
        <div class="item-container">
          <h2>Attribute baru</h2>
          <div id="tb2">
          </div>
        </div>
      </div>
      <div id="count" hidden>

      </div>
      <input type="button" onclick="importDB()" value="Import" class="btnImport">
    </form>
  </div>

  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="dataTable">
        <table>
          <thead id="thead">
            <th></th>
          </thead>
          <tbody>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>


  <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>