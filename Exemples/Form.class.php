<?php

/**
 * Class Form
 * Permet de générer un formulaire
 */
class Form {

  /**
   * @var array Donnée utilisées par le formulaire
   */
  private $data;

 /**
   * @var string Tag utilisé pour entourer les champs
   */
  public $wrapper = 'p';

  /**
   * @param array $data
   */
  public function __construct($data = array()) 
  {
    $this->data = $data;
  }

  /**
   * @param string $html Code HTML à entourer
   * @return string 
   */
  private function wrapper($html) {
    return "<{this->wrapper}>{$html}</{$this->wrapper}>";
  }


  private function getValue($index) {
    return isset($this->data[$index]) ? $this->data[$index] : null;
  }

  public function input($name)
  {
    return $this->wrapper('<input type="text name="'.$name.'" value="'.$this->getValue($name).'">');
  }

  public function submit()
  {
    return $this->wrapper('<input type="submit" name="submit" value="Envoyer" />');
  }

}