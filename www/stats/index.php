<?php
require_once('../config.php');
$files = scandir(".");

echo "<!DOCTYPE html>\n";
echo "<html>\n";
  echo "<head>\n";
    echo "<title>Download Stats</title>\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">\n";
  echo "</head>\n";

  echo "<body>\n";
    echo "<table>\n";
      echo "<table class=\"tg\">\n"; 
      echo "<tr>\n"; 
      echo "<th class=\"tg-head\">FILE</th>\n"; 
      echo "<th class=\"tg-head\">DOWNLOADS</th>\n"; 
      echo "</tr>\n"; 

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
      echo "<tr>\n"; 
      echo "<td class=\"tg-body\">" . substr($file, 0, -4) . "</td>\n"; 
      echo "<td class=\"tg-body\">" . $totalLines . "</td>\n"; 
      echo "</tr>\n"; 
    }
  }
    echo "</table>\n";
  echo "</body>\n";
echo "</html>\n";
?>