<?php
require_once('../config.php');
$files = scandir(".");

echo "<!DOCTYPE html>\n";
echo "<html>\n";
  echo "<head>\n";
    echo "<title>Download Stats</title>\n";
    echo "<style type=\"text/css\">\n"; 
      echo ".tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}\n"; 
      echo ".tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}\n"; 
      echo ".tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}\n"; 
      echo ".tg .tg-s6z2{text-align:center}\n"; 
      echo ".tg .tg-hgcj{font-weight:bold;text-align:center}\n"; 
    echo "</style>\n"; 
  echo "</head>\n";

  echo "<body>\n";
    echo "<table>\n";
      echo "<table class=\"tg\">\n"; 
      echo "  <tr>\n"; 
      echo "    <th class=\"tg-hgcj\">FILE</th>\n"; 
      echo "    <th class=\"tg-hgcj\">DOWNLOADS</th>\n"; 
      echo "  </tr>\n"; 

  foreach ($files as $file) {
    if (substr($file, -4) === ".log") {
      if ($nixWithExec) {
        $totalLines = intval(exec('wc -l ' . $file));
      } else {
        $totalLines = 0;
        $handle = fopen($file, "r");
        while(!feof($handle)){
          $line = fgets($handle);
          $totalLines++;
        }
        fclose($handle);
        $totalLines = $totalLines - 1; //This method counts the last empty line
      }
      echo "  <tr>\n"; 
      echo "    <td class=\"tg-s6z2\">" . substr($file, 0, -4) . "</td>\n"; 
      echo "    <td class=\"tg-s6z2\">" . $totalLines . "</td>\n"; 
      echo "  </tr>\n"; 
    }
  }
    echo "</table>\n";
  echo "</body>\n";
echo "</html>\n";
?>
