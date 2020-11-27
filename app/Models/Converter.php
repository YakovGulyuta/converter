<?php


namespace app\Models;


class Converter
{


  const JPEG = 'jpeg';

  const PNG = 'png';

  const GIF = 'gif';


  /**
   * @param array $post
   * @param array $file
   * @return bool
   */
  public static function convertToPng(array $post, array $file)
  {
    $postfix = explode('/', $file['file']['type']);
    $postfix = $postfix[1];
    $name = uniqid();
    $pathToImg = UPLOAD . $name . '.' . $postfix;
    $pathToWebp = UPLOAD . $name . '.webp';
    $info = pathinfo($pathToWebp);
    if ($post['convert'] == $postfix) {
      self::uploadFile($file, $postfix, $name);
      $newImage = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info['filename'] . '.png';
      $_SESSION['link'] = $newImage;
      return true;
    }
    self::uploadFile($file, $postfix, $name);
    self::convertWebP($postfix, $pathToImg);
    $img = imageCreatefromWebp($pathToWebp);
    imagepng($img, $info['dirname'] . '/' . $info['filename'] . '.png');
    imagedestroy($img);
    unlink($pathToImg);
    unlink($pathToWebp);
    $newImage = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info['filename'] . '.png';
    $_SESSION['link'] = $newImage;
    return true;
  }


  /**
   * @param array $post
   * @param array $file
   * @return bool
   */
  public static function convertToJpeg(array $post, array $file)
  {

    $postfix = explode('/', $file['file']['type']);
    $postfix = $postfix[1];
    $name = uniqid();
    $pathToWebp = UPLOAD . $name . '.webp';
    $info = pathinfo($pathToWebp);
    $pathToImg = UPLOAD . $name . '.' . $postfix;
    if ($post['convert'] == $postfix) {
      self::uploadFile($file, $postfix, $name);
      $newImage = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info['filename'] . '.jpeg';
      $_SESSION['link'] = $newImage;
      return true;
    }
    self::uploadFile($file, $postfix, $name);
    self::convertWebP($postfix, $pathToImg);
    $img = imageCreatefromWebp($pathToWebp);
    imagejpeg($img, $info['dirname'] . '/' . $info['filename'] . '.jpeg');
    $newImage = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info['filename'] . '.jpeg';
    imagedestroy($img);
    unlink($pathToImg);
    unlink($pathToWebp);
    $_SESSION['link'] = $newImage;
    return true;
  }


  /**
   * @param array $post
   * @param array $file
   * @return bool
   */
  public static function convertToGif(array $post, array $file)
  {
    $postfix = explode('/', $file['file']['type']);
    $postfix = $postfix[1];
    $name = uniqid();
    $pathToImg = UPLOAD . $name . '.' . $postfix;
    $pathToWebp = UPLOAD . $name . '.webp';
    $info = pathinfo($pathToWebp);
    self::uploadFile($file, $postfix, $name);
    self::convertWebP($postfix, $pathToImg);
    if ($post['convert'] == $postfix) {
      self::uploadFile($file, $postfix, $name);
      $newImage = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info['filename'] . '.jpeg';
      $_SESSION['link'] = $newImage;
      return true;
    }
    $img = imageCreatefromWebp($pathToWebp);
    imagegif($img, $info['dirname'] . '/' . $info['filename'] . '.gif');
    $newImage = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info['filename'] . '.gif';
    imagedestroy($img);
    unlink($pathToImg);
    unlink($pathToWebp);
    $_SESSION['link'] = $newImage;
    return true;
  }


  /**
   * @param $extension
   * @param $pathToImg
   * @return bool
   */
  private static function convertWebP($extension, $pathToImg)
  {
    switch ($extension) {
      case self::PNG:
        $info = pathinfo($pathToImg);
        $img = imagecreatefrompng($pathToImg);
        imageWebp($img, $info['dirname'] . '/' . $info['filename'] . '.' . 'webp', 100);
        imagedestroy($img);
        return true;
      case self::JPEG:
        $info = pathinfo($pathToImg);
        $img = imagecreatefromjpeg($pathToImg);
        imageWebp($img, $info['dirname'] . '/' . $info['filename'] . '.' . 'webp', 100);
        imagedestroy($img);
        return true;
      case self::GIF:
        $info = pathinfo($pathToImg);
        $img = imagecreatefromgif($pathToImg);
        imageWebp($img, $info['dirname'] . '/' . $info['filename'] . '.' . 'webp', 100);
        imagedestroy($img);
        return true;
    }

  }

  /**
   * @param $file
   * @param $postfix
   * @param $name
   * @return false
   */
  private static function uploadFile($file, $postfix, $name)
  {
    $tmp_name = $file['file']['tmp_name'];
    $result = move_uploaded_file($tmp_name, UPLOAD . $name . '.' . $postfix);
    if (!$result) {
      return false;
    }

  }

}