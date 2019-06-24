<?php

class Primbon{
    private $config;
    private $postData;

    function __construct($config){
        header("Content-type:application/json");
        $this->config = $config;

        $this->postData = $this->checkPOST();
        $this->simpanUser();
        $grabResult = $this->grab();
        $this->getMessage($grabResult);
    }

    function getMessage($result){
        $dom = new DomDocument();
        @$dom->loadHTML($result);
        $finder = new DomXPath($dom);
        $idname = 'body';
        $div = $finder->query("//*[contains(@id, '$idname')]");

        if($div->length === 0){
            echo json_encode(['error'=>'true','message'=>'tidak dapat memproses, ulangi lagi','data'=>[]]);
            exit;
        }

        $result =  $div->item(0)->nodeValue;
        $pos1 = (int) strpos($result, "1. B");
        $pos2 = (int) strpos($result, "2. B");
        $pos3 = (int) strpos($result, "3. B");
        $pos4 = (int) strpos($result, "4. B");
        $pos5 = (int) strpos($result, "5. B");
        $pos6 = (int) strpos($result, "6. B");
        $pos7 = (int) strpos($result, "*Jangan mudah memutuskan");

        $hasil = array(
            'nama1'=> $_POST['nama1'],
            'tgl1'=> $_POST['tgl1'],
            'bln1'=> $_POST['bln1'],
            'thn1'=> $_POST['thn1'],
            'nama2'=> $_POST['nama2'],
            'tgl2'=> $_POST['tgl2'],
            'bln2'=> $_POST['bln2'],
            'thn2'=> $_POST['thn2'],
            'text1' => substr($result,$pos1,($pos2 - $pos1)),
            'text2' => substr($result,$pos2,($pos3 - $pos2)),
            'text3' => substr($result,$pos3,($pos4 - $pos3)),
            'text4' => substr($result,$pos4,($pos5 - $pos4)),
            'text5' => substr($result,$pos5,($pos6 - $pos5)),
            'text6' => substr($result,$pos6,($pos7 - $pos6))
        );
        
        echo json_encode(['error'=>'false','message'=>'','data'=>[$hasil]]);
    }

    public function checkPOST(){
        if(!isset($_POST['nama1']) or empty($_POST['nama1'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['tgl1']) or empty($_POST['tgl1'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['bln1']) or empty($_POST['bln1'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['thn1']) or empty($_POST['thn1'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['nama2']) or empty($_POST['nama2'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['tgl2']) or empty($_POST['tgl2'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['bln2']) or empty($_POST['bln2'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        if(!isset($_POST['thn2']) or empty($_POST['thn2'])){
            echo json_encode(['error'=>'true','message'=>'parameter tidak lengkap','data'=>[]]);
            exit;
        }
        
        //assign post parameter to array
        return $data = array(
            'nama1'=> $_POST['nama1'],
            'tgl1'=> $_POST['tgl1'],
            'bln1'=> $_POST['bln1'],
            'thn1'=> $_POST['thn1'],
            'nama2'=> $_POST['nama2'],
            'tgl2'=> $_POST['tgl2'],
            'bln2'=> $_POST['bln2'],
            'thn2'=> $_POST['thn2'],
            'submit'=> 'Submit!' 
        );

    }

    function grab(){
        // Prepare new cURL resource
        $ch = curl_init($this->config['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postData);

        // Submit the POST request
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        // Close cURL session handle
        curl_close($ch);
        return $result;
    }

    function simpanUser(){
        $host = 'localhost';
        $dbname = 'primbon';
        $dbuser = 'root';
        $dbpass = '';

        $postData = json_encode($this->postData);
        $data = array(
            'userData'=> (string) $postData,
            'ipAddress'=> $_SERVER['REMOTE_ADDR']
        );
        try {
            //code...
            $db = new PDO("mysql:host=$host;dbname=$dbname",$dbuser,$dbpass);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sql = 'INSERT INTO `history` (`userData`, `ipAddress`) VALUES (:userData, :ipAddress)';
            $stmt = $db->prepare($sql)->execute($data);
            $stmt = null;
            $db = null;

        } catch (PDOException $e) {
            //throw $th;
            var_dump($e);
            echo json_encode(['error'=>'true','message'=>'Koneksi database bermasalah','data'=>[]]);
            die();
        }
    }

}

if(!isset($_GET['user']) or empty($_GET['user'])){
    $config = array(
        'url' => 'http://www.primbon.com/ramalan_jodoh.php'
    );
    $primbon = new Primbon($config);
}else{
    if($_GET['user'] != 'gagakSeta'){
        exit;
    }
    $host = 'localhost';
    $dbname = 'primbon';
    $dbuser = 'root';
    $dbpass = '';

    try {
        //code...
        $db = new PDO("mysql:host=$host;dbname=$dbname",$dbuser,$dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
        $sql = 'SELECT `userData` FROM history ORDER BY `createAt` DESC LIMIT 10';
        $stmt = $db->query($sql)->fetchAll();
        foreach ($stmt as $row) {
            echo $row['userData']."<br />\n";
        }
        $stmt = null;
        $db = null;

    } catch (PDOException $e) {
        //throw $th;
        var_dump($e);
        die();
    }

}


?>