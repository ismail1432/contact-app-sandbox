<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 01/10/2017
 * Time: 09:29
 */

namespace AppBundle\Printing;


/**
 * Interface FormatterInterface
 * @package AppBundle\Printing
 */
interface FormatterInterface
{
    public function format($message);
}