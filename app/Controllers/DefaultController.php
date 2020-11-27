<?php


namespace app\Controllers;


use app\Services\Converters\ConverterService;
use Exception;

class DefaultController
{

  /**
   * @var ConverterService
   */
  private $converterService;

  /**
   * Converter constructor.
   */
  public function __construct(ConverterService $converterService)
  {
    $this->converterService = $converterService;
  }
  public function convert($post, $file)
  {

   $result = $this->converterService->convert($post, $file);
   if ($result){
     header('Location: /result');
   }
  }
}