<?php


namespace app\Services\Converters\Repositories;


interface ConverterRepositoryInterface
{

  public function convert(array $post, array $file);

}