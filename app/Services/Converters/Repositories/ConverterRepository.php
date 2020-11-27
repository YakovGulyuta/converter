<?php


namespace app\Services\Converters\Repositories;


use app\Models\Converter;

class ConverterRepository implements ConverterRepositoryInterface
{

  public function convert($post, $file)
  {

    switch ($post['convert']) {
      case Converter::GIF:
        Converter::convertToGif($post, $file);
        return true;
      case Converter::JPEG:
        Converter::convertToJpeg($post, $file);
        return true;
      case Converter::PNG:
        Converter::convertToPng($post, $file);
        return true;
    }
  }
}