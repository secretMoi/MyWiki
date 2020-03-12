<?php
$root = '/modules/bbcode/';
return '<!-- jQuery -->
	<script type="text/javascript" src="' . $root . 'sets/bbcode/jquery-min.js"></script>
	<!-- markItUp! -->
	<script type="text/javascript" src="' . $root . 'jquery.markitup.js"></script>
	<!-- markItUp! toolbar settings -->
	<script type="text/javascript" src="' . $root . 'sets/bbcode/set.js"></script>

    <!-- markItUp! skin -->
    <link rel="stylesheet" type="text/css" href="' . $root . 'skins/simple/style.css">
    <!--  markItUp! toolbar skin -->
    <link rel="stylesheet" type="text/css" href="' . $root . 'sets/bbcode/style.css">

    <script type="text/javascript">
        $(function() {
                $(\'textarea\').markItUp(mySettings);
            }
        );
    </script>';