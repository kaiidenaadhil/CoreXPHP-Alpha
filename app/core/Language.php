<?php

class Language {
  private static $instance;
  private $language;
  private $data;

  private function __construct() {
    $this->language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
    $this->loadLanguageData();
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new Language();
    }

    return self::$instance;
  }

  public function setLanguage($language) {
    $this->language = $language;
    $this->loadLanguageData();
  }

  public function getLanguage() {
    return $this->language;
  }

  public function get($key) {
    return isset($this->data[$key]) ? $this->data[$key] : '';
  }

  private function loadLanguageData() {
    $file = "../app/languages/{$this->language}.php";

    if (file_exists($file)) {
      $this->data = include $file;
    } else {
      throw new Exception("Language file for '{$this->language}' not found.");
    }
  }
}

function __($key) {
  return Language::getInstance()->get($key);
}
