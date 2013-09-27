<?php
# This file is built on example code found in the PHP Manual 
# http://php.net/manual/en/function.parse-ini-file.php
#
# Original code:
#   Copyright 2001-2013 The PHP Group <http://www.php.net/copyright.php>
#   License:  Creative Commons Attribution 3.0 License
#   http://creativecommons.org/licenses/by/3.0/legalcode
#
# Modification:
#   Modifications are done by Jan Säll, YASK. No copyright claimed.
#   Lisense covered by original code:  
#   Creative Commons Attribution 3.0 License
#   http://creativecommons.org/licenses/by/3.0/legalcode

function parseIniFile($file, $process_sections = false) {
  $process_sections = ($process_sections !== true) ? false : true;

  $ini = file($file);
  if (count($ini) == 0) {return array();}

  $sections = array();
  $values = array();
  $result = array();
  $globals = array();
  $i = 0;
  foreach ($ini as $line) {
    $line = trim($line);
    $line = str_replace("\t", " ", $line);

    // Comments
    if (!preg_match('/^[a-zA-Z0-9[]/', $line)) {continue;}

    // Sections
    if ($line{0} == '[') {
      $tmp = explode(']', $line);
      $sections[] = trim(substr($tmp[0], 1));
      $i++;
      continue;
    }

    // Key-value pair
    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);
    if (strstr($value, ";")) {
      $tmp = explode(';', $value);
      if (count($tmp) == 2) {
        if ((($value{0} != '"') && ($value{0} != "'")) ||
            preg_match('/^".*"\s*;/', $value) || preg_match('/^".*;[^"]*$/', $value) ||
            preg_match("/^'.*'\s*;/", $value) || preg_match("/^'.*;[^']*$/", $value) ){
          $value = $tmp[0];
        }
      } else {
        if ($value{0} == '"') {
          $value = preg_replace('/^"(.*)".*/', '$1', $value);
        } elseif ($value{0} == "'") {
          $value = preg_replace("/^'(.*)'.*/", '$1', $value);
        } else {
          $value = $tmp[0];
        }
      }
    }
    $value = trim($value);
    $value = trim($value, "'\"");

    if ($i == 0) {
      if (substr($line, -1, 2) == '[]') {
        $globals[$key][] = $value;
      } else {
        $globals[$key] = $value;
      }
    } else {
      if (substr($line, -1, 2) == '[]') {
        $values[$i-1][$key][] = $value;
      } else {
        $values[$i-1][$key] = $value;
      }
    }
  }

  for($j = 0; $j < $i; $j++) {
    if ($process_sections === true) {
      $result[$sections[$j]] = $values[$j];
    } else {
      $result[] = $values[$j];
    }
  }

  return $result + $globals;
}
?>
