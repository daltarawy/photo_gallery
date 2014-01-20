<?php

class Pagenation extends ClassObject {
    // this class will handle the pagenation behavior of any page
    // following attributes are required for pagination fnctionality
    // $total_rows --> total number of rows found in the datastore {db or file}
    // ROWS_PER_PAGE --> number of rows per page
    // construct_pagination_controls --> methhod will return the pagination string which should have:
    // 1- links to the following and precieading pages (if any) up to NUM_OF_PAGES_IN_PAGINATION_STR
    // 2- preserve "Previous" and "Next" place holders even if in first page and last page.

    public $total_rows;
    public $last_page;
    public $current_page;
    public $pagination_str;
    public $page_var_name;
    public $qry_str_page_name;
    public $textline1 = "";
    public $textline2 = "";

    // public function __construct($total_rows, $current_page, $page_var_name = "page", $qry_str_page_name = "test.php") {
    // $this -> total_rows = $total_rows;
    // $this -> current_page = $current_page;
    // $this -> page_var_name = $page_var_name;
    // $this -> qry_str_page_name = $qry_str_page_name;
    // }

    public static function make($total_rows, $current_page, $page_var_name = "page", $qry_str_page_name = "test.php") {
        $pagination = new self;
        $pagination -> total_rows = $total_rows;
        $pagination -> current_page = $current_page;
        $pagination -> page_var_name = $page_var_name;
        $pagination -> qry_str_page_name = $qry_str_page_name;
        return $pagination;
    }

    public function construct_pagination_ctrl_str() {
        $this -> current_page = $this -> check_num($this -> current_page);
        if (isset($this -> current_page) && $this -> current_page != null) {

            $this -> last_page = ceil($this -> total_rows / ROWS_PER_PAGE);
            // This makes sure $this->last_page cannot be less than 1
            if ($this -> last_page < 1) {
                $this -> last_page = 1;
            }
            // Get pagenum from URL vars if it is present, else it is = 1
            // This makes sure the page number isn't below 1, or more than our $this->last_page page
            if (isset($this -> current_page) && $this -> current_page < 1) {
                $this -> current_page = 1;
            } else if ($this -> current_page > $this -> last_page) {
                $this -> current_page = $this -> last_page;
            }

            $this -> textline1 = "Total Number of Records (<b>$this->total_rows</b>)";
            $this -> textline2 = "Page <b>$this->current_page</b> of <b>$this->last_page</b>";
            // Establish the $this->pagination_str variable
            $this -> pagination_str = '';
            // If there is more than 1 page worth of results
            if ($this -> last_page != 1) {
                // We will check if we are in page 1 the previous word will appear but without any hyperlink, just to keep
                // the pagination control string in a constant width so that user can navigate easly without chasing the page numbers
                // If we aren't in the first page then we generate links to the first page, and to the previous page.
                if ($this -> current_page == 1) {
                    $this -> pagination_str .= 'Previous &nbsp; &nbsp;';
                } elseif ($this -> current_page > 1) {
                    $previous = $this -> current_page - 1;
                    $this -> pagination_str .= '<a href="' . $this -> qry_str_page_name . '?' . $this -> page_var_name . '=' . $previous . '">Previous</a> &nbsp; &nbsp; ';
                    // Render clickable number links that should appear on the left of the target page number
                    for ($i = $this -> current_page - NUM_OF_PAGES_IN_PAGINATION_STR; $i < $this -> current_page; $i++) {
                        if ($i > 0) {
                            $this -> pagination_str .= '<a href="' . $this -> qry_str_page_name . '?' . $this -> page_var_name . '=' . $i . '">' . $i . '</a> &nbsp; ';
                        }
                    }
                }
                // Render the target page number, but without it being a link
                $this -> pagination_str .= '' . $this -> current_page . ' &nbsp; ';
                // Render clickable number links that should appear on the right of the target page number
                for ($i = $this -> current_page + 1; $i <= $this -> last_page; $i++) {
                    $this -> pagination_str .= '<a href="' . $this -> qry_str_page_name . '?' . $this -> page_var_name . '=' . $i . '">' . $i . '</a> &nbsp; ';
                    if ($i >= $this -> current_page + NUM_OF_PAGES_IN_PAGINATION_STR) {
                        break;
                    }
                }
                // This does the same as above, only checking if we are on the last page, and then generating the "Next"
                if ($this -> current_page == $this -> last_page) {
                    $this -> pagination_str .= '&nbsp; Next';
                } elseif ($this -> current_page != $this -> last_page) {
                    $next = $this -> current_page + 1;
                    $this -> pagination_str .= ' &nbsp; &nbsp; <a href="' . $this -> qry_str_page_name . '?' . $this -> page_var_name . '=' . $next . '">Next</a> ';
                }
            }
        } else {
            return "";
        }
        return $this -> pagination_str;
    }

    public function check_num($num = null) {
        if (isset($num) && $num != null) {
            return preg_replace('#[^0-9]#', '', $num);
        } else {
            return "";
        }

    }

}
?>