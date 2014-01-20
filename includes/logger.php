<?php

require_once (LIB_PATH . DS . "config.php");

class Logger {

    private $handle;

    // public function __construct($file = LOG_FILE) {
    // $this -> file_open($file);
    // }

    public function file_open($mode = 'at', $file = LOG_FILE) {
        // file open actions
        // if file does not exists create new one
        // if file is not writable show error
        $path = LOG_PATH . DS . $file;
        if (file_exists($path)) {
            if (!is_writable($path)) {
                die("file is not writable.");
            }
        }
        if (!$this -> handle = fopen($path, $mode)) {
            die("Could not open file in " . $mode);
        }
    }

    public function file_close() {
        // file close actions
        if (isset($this -> handle)) {
            fclose($this -> handle);
            unset($this -> handle);
        }
    }

    public function log_action($action, $message = "") {

        $this -> file_open();
        $time = strftime('%Y-%m-%d %H:%M:%S', strtotime("Now"));
        $content = $time . " | " . $action . " : " . $message . "\n";
        fwrite($this -> handle, $content);
        $this -> file_close();

    }

    public function log_clear($message = "", $file = LOG_FILE) {
        $path = LOG_PATH . DS . $file;

        $this -> file_open('w');
        $this -> file_close();
        $this -> log_action("Clear", $message . " cleared the log");
        redirect_to('logfile_new.php');
    }

    public function log_read($file = LOG_FILE) {
        $path = LOG_PATH . DS . $file;
        if (!file_exists($path) || !is_readable($path)) {
            echo '!file_exists($path) || !is_readable($path)';
            Die("file is not found or is not readable.");
        } else {
            // read the file content in a var
            $this -> file_open('r');
            $content = "";
            if (filesize($path) > 0) {
                $content = fread($this -> handle, filesize($path));
                // $content = "test";
            } else {
                $content = "Log file is empty";
            }
            $this -> file_close();
            return $content;
        }
    }

}

$logger = new Logger();
?>