<?php
class DetectType {
  public static function is_string($i) {
    return (
      is_string($i) &&
      (string)$i === $i &&
      !self::is_float($i) &&
      !self::is_numeric($i) &&
      !self::is_percent($i)
    );
  }
  public static function is_float($i, $comma_is_dot = true) {
    if ($comma_is_dot && preg_match('`\d+,\d+`', $i)) {
      $i = floatval(str_replace(',', '.', $i));
    }
    $result = (
      (float)$i === $i &&
      (float)$i !== (int)$i &&
      filter_var($i, FILTER_VALIDATE_FLOAT) &&
      !filter_var($i, FILTER_VALIDATE_INT)
    );
    if (!$result) {
      if (self::is_percent($i)) {
        $without_percent_sign = str_replace('%', '', $i);
        if (is_numeric($without_percent_sign) && preg_match('`\d+\.\d+`', $without_percent_sign)) {
          $without_percent_sign = floatval($without_percent_sign);
        }
        $result = (
          (float)$without_percent_sign === $without_percent_sign &&
          (float)$without_percent_sign !== (int)$without_percent_sign &&
          filter_var($without_percent_sign, FILTER_VALIDATE_FLOAT) &&
          !filter_var($without_percent_sign, FILTER_VALIDATE_INT)
        );
      } else {
        if (is_string($i) && is_numeric($i) && preg_match('`\d+\.\d+`', $i)) {
          $i = floatval($i);
        }
        $result = (
          filter_var($i, FILTER_VALIDATE_FLOAT) &&
          !filter_var($i, FILTER_VALIDATE_INT)
        );
      }
    }
    return $result;
  }
  public static function is_numeric($i) {
    return (
      self::is_integer($i) ||
      (
        self::is_float($i) &&
        !self::is_percent($i)
      )
    );
  }
  public static function is_integer($i) {
    return (
      is_numeric($i) &&
      !self::is_float($i)
    );
  }
  public static function is_percent($i) {
    if (preg_match('`.*?%$`', $i)) {
      $without_percent_sign = str_replace('%', '', $i);
      return (
        self::is_numeric($without_percent_sign) ||
        self::is_float($without_percent_sign)
      );
    }
    return false;
  }
  public static function is_negative($i) {
    $result = null;
    if (self::is_percent($i)) {
      $without_percent_sign = str_replace('%', '', $i);
      if (
        self::is_numeric($without_percent_sign) ||
        self::is_float($without_percent_sign)
      ) {
        $result = ($without_percent_sign < 0);
      }
    } else {
      $result = (
        (
          self::is_numeric($i) ||
          self::is_float($i)
        ) &&
        (
          $i < 0
        )
      );
    }
    return $result;
  }
  public static function is_positive($i) {
    $result = null;
    if (self::is_percent($i)) {
      $without_percent_sign = str_replace('%', '', $i);
      if (
        self::is_numeric($without_percent_sign) ||
        self::is_float($without_percent_sign)
      ) {
        $result = ($without_percent_sign > 0);
      }
    } else {
      $result = (
        (
          self::is_numeric($i) ||
          self::is_float($i)
        ) &&
        (
          $i > 0
        )
      );
    }
    return $result;
  }
  public static function is_zero($i) {
    $result = null;
    if (self::is_percent($i)) {
      $without_percent_sign = str_replace('%', '', $i);
      if (
        self::is_numeric($without_percent_sign) ||
        self::is_float($without_percent_sign)
      ) {
        $i = (int)$without_percent_sign;
      }
    }
    if (self::is_numeric($i)) {
      $result = ((int)$i === 0);
    }
    return $result;
  }
}
?>
