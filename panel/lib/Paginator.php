<?php
class Paginator {
    private $conn;
    private $query;
    private $limit;
    private $page;
    private $total_records;

    public function __construct($conn, $query, $limit) {
        $this->conn = $conn;
        $this->query = $query;
        $this->limit = $limit;
        $this->setTotalRecords();
    }

    // Set the current page (default is 1)
    public function setPage($page) {
        $this->page = ($page > 0) ? $page : 1;
    }

    // Get total records for the given query (without limit and offset)
    private function setTotalRecords() {
        // Modify the query to count total records (remove ORDER BY if necessary)
        $count_query = "SELECT COUNT(*) as total FROM (" . $this->query . ") as subquery";
        $result = $this->conn->query($count_query);
        $this->total_records = $result->fetch_assoc()['total'];
    }

    // Fetch records for the current page
    public function getData() {
        $offset = ($this->page - 1) * $this->limit;
        // Add LIMIT and OFFSET to the original query
        $paged_query = $this->query . " LIMIT {$this->limit} OFFSET $offset";
        return $this->conn->query($paged_query);
    }
/*
 <nav aria-label="Page navigation" class="mt-4">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left"></i></a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </nav>
*/
    // Generate pagination links
    public function createLinks() {
        $total_pages = ceil($this->total_records / $this->limit);
        $html = '<nav aria-label="Page navigation" class="mt-4">
          <ul class="pagination">';

        // "Prev" button
        if ($this->page > 1) {
            $prev_page = $this->page - 1;
            $html .= '<li class="page-item"><a class="page-link" href="?page='.$prev_page.'"><i class="fa fa-chevron-left"></i></a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left"></i></a></li>';
        }

        // Page numbers (1 to 3)
        $start_page = 1;
        $end_page = 3;
        for ($i = $start_page; $i <= min($end_page, $total_pages); $i++) {
            if ($i == $this->page) {
                //$html .= "<strong>$i</strong> ";
                $html .= '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
            } else {
                //$html .= "<a href='?page=$i'>$i</a> ";
                $html .= '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li> ';
            }
        }

        // "Next" button
        if ($this->page < $total_pages) {
            $next_page = $this->page + 1;
            $html .= '<li class="page-item"><a class="page-link" href="?page='.$next_page.'"><i class="fa fa-chevron-right"></i></a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a></li>';
        }

        $html .= '</ul>
        </nav>';
        return $html;
    }
}
?>
