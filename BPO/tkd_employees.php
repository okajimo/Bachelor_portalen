<?
//some constants
include("utilities.php");
//Open a database connection
$host = 'nexus';
$user = 'nobody';
$pw = '';
$dbname = 'ansatte';
$con1 = mysqli_connect($host, $user, $pw, $dbname);
$host = 'nexus';
$user = 'geirs';
$pw = '******';
$dbname = 'project';
$con2 = mysqli_connect($host, $user, $pw, $dbname);
$handle = fopen('/iu/nexus/ua/www-data/www/data/bachelorprosjekt/reg/crontab_employees.html', 'w');
$time = date('d.m.Y H:i');
fwrite($handle, "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'\n");
fwrite($handle, "    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n");
fwrite($handle, "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>\n");
fwrite($handle, "<head>\n");
fwrite($handle, "<title>bachelorprosjekt</title>\n");
fwrite($handle, "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n");
fwrite($handle, "<link rel='stylesheet' type='text/css' href='project.css' />\n");
fwrite($handle, "</head>\n");
fwrite($handle, "<body>\n");
fwrite($handle, "<h1>Bachelorprosjekt</h1>\n");
fwrite($handle, "<h2>Crontab $time</h2>\n");
fwrite($handle, "<h2>Slettede ansatte</h2>\n");
fwrite($handle, "<table cellspacing='0' cellpadding='4'>\n");
fwrite($handle, "  <tr>\n");
fwrite($handle, "    <td class='tlframe'><b>Login</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Fornavn</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Etternavn</b></td>\n");
fwrite($handle, "  </tr>\n");
//Loop through all existing employees (except externals and 'geirs')
$sql = "select * from users where code != 'external' and user != 'geirs' order by user";
$recordset = mysqli_query($con2, $sql);
$ndel = 0;
while ($record = mysqli_fetch_object($recordset)) {
  $user = $record->user;
  $firstname = $record->firstname;
  $lastname = $record->lastname;
//Check if this employee is in table tkd_ansatte of database ansatte
  $sql = "select konto from tkd_ansatte where konto = '$user'";
  $recordset1 = mysqli_query($con1, $sql);
  $n = mysqli_num_rows($recordset1);
  if (!$n) {
//The employee is not in tkd_ansatte so delete
    fwrite($handle, "  <tr>\n");
    fwrite($handle, "    <td class='lframe'>$user</td>\n");
    fwrite($handle, "    <td class='frame'>$firstname</td>\n");
    fwrite($handle, "    <td class='frame'>$lastname</td>\n");
    fwrite($handle, "  </tr>\n");
    $sql = "delete from users where user = '$user'";
    mysqli_query($con2, $sql);
    $ndel++;
  }
}
fwrite($handle, "</table>\n");
fwrite($handle, "<p>$ndel ansatte ble slettet!</p>\n");
fwrite($handle, "<h2>Oppdaterte eller innsatte ansatte</h2>\n");
fwrite($handle, "<table cellspacing='0' cellpadding='4'>\n");
fwrite($handle, "  <tr>\n");
fwrite($handle, "    <td class='tlframe'><b>Bruker</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Fornavn</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Etternavn</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Tittel</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Epost</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Kode</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Tlf</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Rom</b></td>\n");
fwrite($handle, "    <td class='tframe'><b>Endring</b></td>\n");
fwrite($handle, "  </tr>\n");
//Loop through all employees in tkd_ansatte
$sql = "select konto, fnavn, enavn, tittel, epost, sekkode, tlf, romkode from tkd_ansatte where (sekkode = ";
$sql .= "'tkd-u-it' and status = 'TILSATT') or konto = 'geirs' order by konto";
$recordset = mysqli_query($con1, $sql);
$nupd = 0;
$nins = 0;
while ($record = mysqli_fetch_object($recordset)) {
  $username = $record->konto;
  $lastname = $record->enavn;
  $firstname = $record->fnavn;
  $level = 0;
  $email = $record->epost;
  $code = $record->sekkode;
//Check if this employee already is in users
  $sql = "select * from users where user = '$username'";
  $recordset2 = mysqli_query($con2, $sql);
  fwrite($handle, "  <tr>\n");
  fwrite($handle, "    <td class='lframe'>$username</td>\n");
  fwrite($handle, "    <td class='frame'>$firstname</td>\n");
  fwrite($handle, "    <td class='frame'>$lastname</td>\n");
  fwrite($handle, "    <td class='frame'>$level</td>\n");
  fwrite($handle, "    <td class='frame'>$email</td>\n");
  fwrite($handle, "    <td class='frame'>$code</td>\n");
  $n = mysqli_num_rows($recordset2);
  if ($n) {
//The employee exist so update
    fwrite($handle, "    <td class='frame'>Oppdatert</td>\n");
    $sql = "update users set firstname = '$firstname', lastname = '$lastname', title = '$title', ";
    $sql .= "email = '$email', sex = '$code', level = '$level' where user = '$username'";
    $nupd++;
  } else {
//The employee is new so insert
    fwrite($handle, "    <td class='frame'><b>Innsatt</b></td>\n");
    $sql = "insert into users values ('$username', '$level', '$firstname', '$lastname', '$email', '',";
    $sql .= "'$code')";
    $nins++;
  }
  fwrite($handle, "  </tr>\n");
  mysqli_query($con2, $sql);
}
fwrite($handle, "</table>\n");
fwrite($handle, "<p>$nupd ansatte ble oppdatert!</p>\n");
fwrite($handle, "<p>$nins ansatte ble innsatt!</p>\n");
//fwrite($handle, "<p>" . implode('<br />', $debug) . "</p>\n");
fwrite($handle, "<p>\n");
fwrite($handle, "  <a href='http://validator.w3.org/'>\n");
$text = "    <img style='border:0' src='../../../img/valid-xhtml10.png' alt='Valid XHTML 1.0 Strict' height='31' ";
$text .= "width='88' />\n";
fwrite($handle, $text);
fwrite($handle, "  </a>\n");
fwrite($handle, "  <a href='http://jigsaw.w3.org/css-validator/'>\n");
fwrite($handle, "    <img style='border:0' src='../../../img/vcss.png' alt='Valid CSS!' />\n");
fwrite($handle, "  </a>\n");
fwrite($handle, "</p>\n");
fwrite($handle, "</body>\n");
fwrite($handle, "</html>\n");
fclose($handle);
?>
<?=implode('<br />', $debug)?>
