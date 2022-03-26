<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
  <title>Document</title>
</head>

<body>
  <h1>It's Work</h1>
  <?= form_open('home/importDB'); ?>
  <div class="container">
    <div class="item-container">
      <select name="tbl" id="tbl">
        <option value="">1</option>
      </select>
    </div>
    <div class="item-container">
      <select name="tbl" id="tbl">
        <option value="">1</option>
      </select>
    </div>
    <div class="item-container">
      <div id="tb1">
        <?php $i = 1;
        $j = 1;
        foreach ($statement as $key) : ?>
          <select name="atribut<?= $i++; ?>" id="atribut<?= $j++; ?>" onchange="pilih()">
            <option value="">Pilih</option>
            <?php foreach ($statement as $key) : ?>
              <option value="<?= $key['Field']; ?>"><?= $key['Field']; ?></option>
            <?php endforeach; ?>
          </select>
          <br>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="item-container">
      <div id="tb2">
        <?php foreach ($statement as $key) : ?>
          <input type="text" name="<?= $key['Field']; ?>" id="<?= $key['Field']; ?>" value="<?= $key['Field']; ?>">
          <br>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <button type="submit" name="migrasi" id="migrasi">Migrasi -></button>
  </form>


  <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>