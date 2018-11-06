<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:54 PM
 */

namespace App\Entities;


/**
 * Class Page
 * @package App\Entities
 */
class Page
{

    /**
     * @var int
     */
    private $pageNumber;
    /**
     * @var array
     */
    private $pageLinks;


    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber(int $pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return array
     */
    public function getPageLinks(): array
    {
        return $this->pageLinks;
    }

    /**
     * @param array $pageLinks
     */
    public function setPageLinks(array $pageLinks): void
    {
        $this->pageLinks = $pageLinks;
    }


}