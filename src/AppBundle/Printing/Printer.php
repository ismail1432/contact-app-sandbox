<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 01/10/2017
 * Time: 09:30
 */

namespace AppBundle\Printing;


class Printer
{
    const SERVICENAME = 'printing.printer';

    public function registerFormatter($format, FormatterInterface $formatter)
    {

    }

    //delegate the job to a dedicated formatter
    public function print($format, $message)
    {

    }


}