<?php

class Model_Test {
  /**
   * Test Value
   * @var integer
   */
  protected $value;
  
  public function __construct( $value )
  {
    $this->value = $value;
  }
  
  public function getValue()
  {
    return $this->value;
  }
}