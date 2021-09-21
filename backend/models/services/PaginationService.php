<?php
/**
 * User: ansaus
 * Date: 19.09.2021
 */

namespace app\models\services;


class PaginationService
{
    private $perPageRowCount = 5;
    private $currentPage;
    private $rowCount;

    /**
     * @return mixed
     */
    public function getPerPageRowCount()
    {
        return $this->perPageRowCount;
    }

    /**
     * @param mixed $perPageRowCount
     */
    public function setPerPageRowCount($perPageRowCount): void
    {
        $this->perPageRowCount = intval($perPageRowCount);
    }

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param mixed $currentPage
     */
    public function setCurrentPage($currentPage): void
    {
        $this->currentPage = intval($currentPage);
    }

    /**
     * @return mixed
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /**
     * @param mixed $rowCount
     */
    public function setRowCount($rowCount): void
    {
        $this->rowCount = intval($rowCount);
    }

    public function getLimit() {
        return $this->perPageRowCount;
    }

    public function getPageCount() {
        return ceil($this->rowCount / $this->perPageRowCount);
    }

    public function getOffset() {
        return ($this->currentPage - 1) * $this->perPageRowCount;
    }
}
