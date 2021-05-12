<!DOCTYPE html>
<html>
<body>
<form action="" method="post">
    <input type="submit" name="button1" value="GO" />
    <input type="text" name="showInput" value=""/>
</form>
    <?php 
    include 'do.php';
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['button1']))
    {
        $link = htmlspecialchars($_POST['showInput']);
        $link = str_replace(" ", "%20", $link);
        $jsondata = loadURL("https://apis.justwatch.com/content/titles/de_DE/popular?language=de&body=%7B%22page_size%22:1,%22page%22:1,%22query%22:%22". $link . "%22,%22content_types%22:[%22show%22,%22movie%22]%7D");
        try {
            $json = json_decode($jsondata,true);
            $numbers = count($json['items'][0]['offers']);
            echo nl2br (($json['items'][0]['title']). "\n");  
            for ($i = 0; $i <= ($numbers - 1); $i++) {
                if ($json['items'][0]['offers'][$i]['monetization_type'] == "flatrate") {
                    echo nl2br(($json['items'][0]['offers'][$i]['urls']['standard_web'] . "\n"));
                }
            }    
        } catch (Exception $e){
            echo "gibts nicht.";
        }
    }
    ?>
</body>
</html>