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
  <h1>Migrasi Database</h1>
  <?= form_open_multipart('Home/importDB'); ?>
  <div class="container">
    <div class="item-container">
      <h2>Database lama</h2>
      <select name="databases1" id="databases1">
        <option value="">Pilih</option>
        <?php foreach ($dbs as $db) : ?>
          <option value="<?= $db; ?>"><?= $db; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="item-container">
      <h2>Database baru</h2>
      <select name="databases2" id="databases2" onchange="pilihTabel()">
        <option value="">Pilih</option>
        <?php foreach ($dbs as $db) : ?>
          <option value="<?= $db; ?>"><?= $db; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="item-container">
      <h2>Table lama</h2>
      <select name="tables1" id="tables1">
        <option value=''>Pilih</option>
      </select>
    </div>
    <div class="item-container">
      <h2>Table baru</h2>
      <select name="tables2" id="tables2" onchange="pilihAttr()">
        <option value=''>Pilih</option>
      </select>
    </div>

    <div class="item-container">
      <h2>Attribute lama</h2>
      <div id="tb1">
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
  <button type="button" name="generate" id="generate" onclick="importDB()">Generate</button>
  <button type="submit">Import -></button>
  </form>


  <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>