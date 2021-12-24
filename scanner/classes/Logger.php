<?php

class Logger{

	private $logFile;
	private $fp;
	
	public function lfile($path) {
        $this->logFile = $path;
    }

    public function lwrite($message){
	
        if(!$this->fp) 
			$this->lopen();
        $scriptName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        $time = date('H:i:s:ms');
        fwrite($this->fp, "$time ,$scriptName, $message\n");
    }

    private function lopen(){

        $lfile = $this->logFile;
        $today = date('Y-m-d');
        $this->fp = fopen($lfile . '_' . $today . '.txt', 'a') or exit("Can't open $lfile!");
    }
}
?>
