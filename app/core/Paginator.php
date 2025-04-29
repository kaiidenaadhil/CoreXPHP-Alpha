<?php
class Paginator
{
    private $totalRecords;
    private $currentPage;
    private $perPage;
    private $totalPages;

    public function __construct($totalRecords, $currentPage = 1, $perPage = 10)
    {
        $this->totalRecords = $totalRecords;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->totalPages = ceil($totalRecords / $perPage);
    }

    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getLimit()
    {
        return $this->perPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getPaginationData()
    {
        return [
            'total_records' => $this->totalRecords,
            'current_page' => $this->currentPage,
            'per_page' => $this->perPage,
            'total_pages' => $this->totalPages,
        ];
    }

    public function getPageUrl($page)
    {
        $url = $_SERVER['REQUEST_URI'];
        $query = parse_url($url, PHP_URL_QUERY);

        // Remove existing page parameters from the URL
        $url = preg_replace('/&?page=\d+/', '', $url);

        // Append the new page parameter to the URL
        if ($query) {
            $url .= '&page=' . $page;
        } else {
            $url .= '?page=' . $page;
        }
        return $url;
    }

    public function render()
    {
        $html = '<ul class="pagination">';
        
        // Previous button
        $html .= '<li class="page-item' . ($this->currentPage == 1 ? ' disabled' : '') . '"><a class="page-link" href="' . $this->getPageUrl($this->currentPage - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
        
        // First page
        if ($this->totalPages > 1) {
            $html .= '<li class="page-item' . ($this->currentPage == 1 ? ' active' : '') . '"><a class="page-link" href="' . $this->getPageUrl(1) . '">First Page</a></li>';
        }
        
        // Pages in between
        $startPage = max($this->currentPage - 3, 1);
        $endPage = min($this->currentPage + 3, $this->totalPages);
        for ($i = $startPage; $i <= $endPage; $i++) {
            $html .= '<li class="page-item' . ($this->currentPage == $i ? ' active' : '') . '"><a class="page-link" href="' . $this->getPageUrl($i) . '">' . $i . '</a></li>';
        }
        
        // Last page
        if ($this->totalPages > 1) {
            $html .= '<li class="page-item' . ($this->currentPage == $this->totalPages ? ' active' : '') . '"><a class="page-link" href="' . $this->getPageUrl($this->totalPages) . '">Last Page</a></li>';
        }
        
        // Next button
        $html .= '<li class="page-item' . ($this->currentPage == $this->totalPages ? ' disabled' : '') . '"><a class="page-link" href="' . $this->getPageUrl($this->currentPage + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
        
        // Page number input field
        $html .= '<li class="page-item"><form class="form-inline" style="display:flex;margin-top: -0.5rem;">
        <input type="text" class="pagination-search" name="page" placeholder="Page" value="' . $this->currentPage . '">
        <button type="submit" class="pagination-search-button">Go</button></form></li>';
        
        $html .= '</ul>';
    
        return $html;
    }
}
?>
