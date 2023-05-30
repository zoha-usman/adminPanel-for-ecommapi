<?php
@$dbc = mysqli_connect('localhost', 'root', '', 'ecommdb');
date_default_timezone_set("Indian/Maldives");
if (!$dbc) {
  echo mysqli_connect_error();
  exit();
}
function getMessage($msg, $sts)
{
  if (!empty($msg)) {
    # code...
    echo "<div class='alert alert-" . $sts . "'>" . $msg . "</div>";
  }
}
function getSweetMessage($title, $msg, $type)
{
  if (!empty($msg)) {
    # code...
?>
    <script>
      swal({
          title: "<?= $title ?>",
          text: "<?= $msg ?>",
          type: "<?= $type ?>",
          showCancelButton: false,
          confirmButtonClass: "btn-success",
          confirmButtonText: 'OK',
          closeOnConfirm: false
        },
        function() {});
    </script>
  <?php
  }
}



function redirect($url, $time = 0)
{

  ?>

  <script>
    setTimeout(function() {

      window.location = '<?= $url ?>';

    }, <?= $time ?>)
  </script>

<?php

}


function fetchRecord($dbc, $table, $fld, $data)
{

  return  mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM $table WHERE $fld='$data'"));
}

function insert_data($dbc, $table, $data)
{

  global $msg;

  global $sts;

  $fld = $values = "";

  $i = 0;

  $comma = ",";

  $count = count($data);

  foreach ($data as $index => $value) {

    # code...

    if (($count - 1) == $i) {

      $comma = "";
    }

    $fld = $fld . $index . $comma;

    if ($index = !"post_body") {

      # code...

      $val = validate_data($dbc, $value);
    } else {

      $val = $value;
    }

    @$values = $values . "'" . $val . "'" . $comma;

    $i++;
  }

  return mysqli_query($dbc, "INSERT INTO $table($fld) VALUES($values)");
}

function update_data($dbc, $table, $data, $col, $val)
{

  $set_data = "";

  $i = 0;

  $comma = ",";

  $count = count($data);

  //debug_mode($data);

  foreach ($data as $index => $value) {

    # code...

    if (($count - 1) == $i) {

      $comma = "";
    }

    $set_data = $set_data . $index . "='" . validate_data($dbc, $value) . "'" . $comma;

    $i++;
  }

  return mysqli_query($dbc, "UPDATE $table SET $set_data WHERE $col='$val'");
}

function validate_data($dbc, $data)
{

  return mysqli_real_escape_string($dbc, strip_tags($data));
}
function getLastId($dbc, $table, $fld)
{
  $q = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM $table ORDER BY $fld DESC LIMIT 1"));
  return $q[$fld];
}
?>