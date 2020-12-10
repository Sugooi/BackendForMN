

<?php

class Utils

{   



    private $conn;



    function __construct()

    {

        $servername = "localhost";

        $username = "id15620363_adil";

        $password = "FbA3EN1~2&^<_Z\p";


        try {

        $this->conn = new PDO("mysql:host=$servername;dbname=id15620363_mn", $username, $password);

        // set the PDO error mode to exception

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return "Connected successfully";  

        } catch(PDOException $e) {

        echo "Connection failed: " . $e->getMessage();

        }

    }



    function save_QRCode(){



        $token=$this->randomToken();



        $hash= md5($token);



            try {

            $sql = "insert into ActivatedCodes(activatedcodes) values(:qrcode)";



            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':qrcode', $hash);

            $stmt->execute();



            $conn = null; 



            return $token;



        } catch (PDOException $e) {

             //echo "Error: " . $e->getMessage();



            $conn = null; 



            return "unsuccessful";

        }



    }



    function verify_QRCode($qrcode){



        $hash=md5($qrcode);







        try {



            $sql = 'SELECT activatedcodes FROM ActivatedCodes

                WHERE activatedcodes = :qrcode

                LIMIT 1';



            $stmt = $this->conn->prepare($sql);



            $stmt->bindParam(':qrcode', $hash);

            $stmt->execute();

            $arr = $stmt->fetch();



            if (!$arr) {

                $conn = null; 

                return 'invalid';}

            // echo $arr['activatedcodes'];

            $conn = null; 



            return 'valid';

            

        } catch (PDOException $e) {

            // echo "Error: " . $e->getMessage();

            $conn = null; 



            return "error";

        }



    }



    function calculate_risk($key){



        try{



            $sql = 'SELECT infectedkeys FROM InfectedKeys

                WHERE infectedkeys = :value

                LIMIT 1';



            $stmt = $this->conn->prepare($sql);



            $stmt->bindParam(':value', $key);

            $stmt->execute();

            $arr = $stmt->fetch();



            if ($arr) 



            {

                //found key

                return 'found';

            }

            // echo $arr['activatedcodes'];  



        } catch (PDOException $e) {

             echo "Error: " . $e->getMessage();

             return "error";

        }

        



        return 'notfound';

    }



        function save_infected_keys($keys){



        foreach ($keys as $value) {



            try {

            $sql = "insert into InfectedKeys(infectedkeys) values(:value)";



            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':value', $value);

            $stmt->execute();

            



        } catch (PDOException $e) {

             echo "Error: " . $e->getMessage();

             return "failed";

        }

        

        }



        return "success";

    }





    function randomToken()

    {

        $alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

        $pass        = array(); //remember to declare $pass as an array

        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

        for ($i = 0; $i < 8; $i++) {

            $n      = rand(0, $alphaLength);

            $pass[] = $alphabet[$n];

        }

        return implode($pass); //turn the array into a string

    }

}



?>

