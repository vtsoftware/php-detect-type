<?php
require('detect-type.class.php');

$variables = array(
  '123.45',
  '-123.45',
  '123,45',
  '-123,45',
  123.45,
  -123.45,

  0,
  '0',
  '0%',

  '123',
  '-123',
  123,
  -123,

  'bla',
  'bl01a',
  '123%',
  '123.45%',
  '123,45%',
  '-123%',
  '-123.45%',
  '-123,45%',
);

echo '<table cellpadding="6"><tr><th>Value</th><th>Type</th><th>Is float?</th><th>Is integer?</th><th>Is numeric?</th><th>Is percent?</th><th>Is string?</th><th>Is negative?</th><th>Is positive?</th><th>Is zero?</th></tr>';
foreach ($variables as $i) {
  echo '<tr>';
  echo '<td align="center">'.$i.'</td>';
  echo '<td align="center">'.gettype($i).'</td>';
  echo '<td align="center">'.(DetectType::is_float($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_integer($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_numeric($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_percent($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_string($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_negative($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_positive($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '<td align="center">'.(DetectType::is_zero($i) ? 'X' : '<font color="#ddd">X</font>').'</td>';
  echo '</tr>';
}
echo '</table>';
