<?php


namespace app\Services\Converters;


use app\Services\Converters\Repositories\ConverterRepositoryInterface;

class ConverterService
{
  /**
   * @var ConverterRepositoryInterface
   */
  private $convertRepository;

  /**
   * ConverterService constructor.
   */
  public function __construct(ConverterRepositoryInterface $converterRepository)
  {
    $this->convertRepository = $converterRepository;
  }

  public function convert($post, $file)
  {
    $result = $this->convertRepository->convert($post, $file);
    return $result;
  }
}