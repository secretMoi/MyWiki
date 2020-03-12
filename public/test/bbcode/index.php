<html>
<head>
	<!-- jQuery -->
	<script type="text/javascript" src="../../modules/bbcode/sets/bbcode/jquery-min.js"></script>
	<!-- markItUp! -->
	<script type="text/javascript" src="../../modules/bbcode/jquery.markitup.js"></script>
	<!-- markItUp! toolbar settings -->
	<script type="text/javascript" src="../../modules/bbcode/sets/bbcode/set.js"></script>

    <!-- markItUp! skin -->
    <link rel="stylesheet" type="text/css" href="../../modules/bbcode/skins/simple/style.css">
    <!--  markItUp! toolbar skin -->
    <link rel="stylesheet" type="text/css" href="../../modules/bbcode/sets/default/style.css">
    <script type="text/javascript">
        $(function() {
                $('textarea').markItUp(mySettings);
            }
        );
    </script>
</head>
<body>
    <p>
        <label>BBCODE</label>
        <p>
        <?php
        if(!empty($_POST)) {
	        $texte = $_POST['test'];
	        $texte = htmlentities($texte, ENT_NOQUOTES, 'UTF-8'); // évite l'injection de code
	        $conversion = array(
	                '\[b\](.*?)\[\/b\]' => '<strong>$1</strong>',
                    '\[i\](.*?)\[\/i\]' => '<em>$1</em>',
                    '\[u\](.*?)\[\/u\]' => '<u>$1</u>',
		            '\[img\](.*?)\[\/img\]' => '<img src="$1" />',
		            '\[url=([^\]]*)\](.*)\[\/url\]' => '<a href="$1">$2</a>'
            );
            foreach ($conversion as $key => $value) {
                $texte = preg_replace('/' . $key . '/', $value, $texte);
            }
            nl2br($texte); // convertit les sauts de ligne
	        echo $texte;
        }
        ?>
        </p>
        <form method="post" action="index.php">
            <textarea name="test"></textarea>
        <input type="submit" value="Tester">
        </form>

    </p>
</body>
</html>