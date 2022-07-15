<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
  <title><?= $tab_title; ?></title>
</head>

<body>
  <h1><?= $title; ?></h1>
  <?= form_open_multipart('Home/importDB'); ?>
  <!-- <div class="container"> -->
    <!-- <div class="item-container"> -->
    <div>
        <br>
        <br>
    </div>

      <h2>Source Database</h2>
      <input name="host_dbsource" type="text" placeholder="host of source database">
      <input name="host_port1" type="text" placeholder="port of source database">
      <input name="username1" type="text" placeholder="username">
      <input name="password1" type="text" placeholder="password">
      <button type="button" name="generate" id="generate" onclick="importDB()">Test Connection</button>
    <!-- </div> -->

      <div>
        <br>
      </div>
      <div id="notif" hidden>
        </div>
      <div>
        <br>
      </div>

      <h2>Database Destination</h2>
      <input name="host_dbdes" type="text" placeholder="host of source database">
      <input name="host_port2" type="text" placeholder="port of source database">
      <input name="username2" type="text" placeholder="username">
      <input name="password2" type="text" placeholder="password">
      <button type="button" name="generate" id="generate" onclick="importDB()">Test Connection</button>

      <div>
        <br>
      </div>
      <div id="notif" hidden>
        </div>
    
      
  </div>

  <!-- </div> -->
  <div>
    <br>
    <br>
    <br>
  </div>

  <button type="submit">Save Configuration</button>
  </form>


  <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>