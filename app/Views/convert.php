<?php
use app\Controllers\DefaultController;
use app\Services\Converters\ConverterService;
use app\Services\Converters\Repositories\ConverterRepository;
$convert = new DefaultController(new ConverterService(new ConverterRepository()));
$convert->convert($_POST, $_FILES);
?>


