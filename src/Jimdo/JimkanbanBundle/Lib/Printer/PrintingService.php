<?php
namespace Jimdo\JimkanbanBundle\Lib\Printer;
use \Jimdo\JimkanbanBundle\Lib\Generator\Service;
use \Jimdo\JimkanbanBundle\Lib\Printer\PrinterInterface;
use \finfo;

class PrintingService
{

    /**
     * @var \Jimdo\JimkanbanBundle\Lib\Generator\Service
     */
    private $generator;

    /**
     * @var \Jimdo\JimkanbanBundle\Lib\Printer\PrinterInterface
     */
    private $printer;

    /**
     * @var \finfo
     */
    private $fileInfo;

    public function __construct(PrinterInterface $printer, Service $generator, finfo $fileInfo)
    {
        $this->printer = $printer;
        $this->generator = $generator;
        $this->fileInfo = $fileInfo;
    }

    public function doPrint($printerId, $html)
    {
        return $this->printer->doPrint($printerId, $this->getFile($html));
    }

    private function getFile($html)
    {
        $file = $this->generator->generateFromHtml($html);

        return array(
            'content' => $file,
            'mime' => $this->getMimeType($file)
        );
    }

    private function getMimeType($file)
    {
        return $this->fileInfo->buffer($file);
    }
}
