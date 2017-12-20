<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_FILES['image'])) {
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$tmp_name = uniqid().uniqid().uniqid().".".$imageFileType;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], 'images/'.$tmp_name)) {
        
    	$command= 'python /var/www/html/caption.py '. $tmp_name . ' 2>&1';
    	$out = shell_exec($command);
        $ara = array(
            "\n" => ""
        );

        $out = str_replace(array_keys($ara), array_values($ara), $out);

        $results = array();
        preg_match_all('/./u', $out, $results);
        $out = '';
        foreach ($results[0] as $res) {
            if($res == '😁')
                $out .= 'happy ';
            else if($res=='😭')
                $out .= 'sad ';
            else if($res=='😐')
                $out .= 'neutral ';
            else if($res=='😯')
                $out .= 'hushed ';
            else
                $out .= $res;
        }


        $output['caption'] = $out;
    	echo json_encode($output);
        unlink('images/'.$tmp_name);

    }
}
?>