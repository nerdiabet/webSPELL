<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/

// important data include
include("_mysql.php");
include("_settings.php");
include("_functions.php");

$_language->readModule('index');
$index_language = $_language->module;
// end important data include

$hide1 = array("forum", "forum_topic");
header('X-UA-Compatible: IE=edge,chrome=1');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    if (
        (isset($_SESSION[ 'language' ]) && ($_SESSION[ 'language' ] == 'ac')) ||
        (isset($_COOKIE[ 'language' ]) && ($_COOKIE[ 'language' ] == 'ac'))
    ) {
        echo '<script type="text/javascript">
            var _jipt = [];
            _jipt.push([\'project\', \'webspell-cms\']);
        </script>
        <script type="text/javascript" src="//cdn.crowdin.com/jipt/jipt.js"></script>';
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="Clanpage using webSPELL 4 CMS">
    <meta name="author" content="webspell.org">
    <meta name="generator" content="webSPELL">

    <!-- Head & Title include -->
    <title><?php echo PAGETITLE; ?></title>
    <base href="<?php echo $rewriteBase; ?>">
    <?php foreach ($components['css'] as $component) {
        echo '<link href="' . $component . '" rel="stylesheet">';
    }
    ?>
    <link href="_stylesheet.css" rel="stylesheet">
    <link
        href="tmp/rss.xml"
        rel="alternate"
        type="application/rss+xml"
        title="<?php echo getinput($myclanname); ?> - RSS Feed">
    <!-- end Head & Title include -->

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button
                type="button"
                class="navbar-toggle"
                data-target=".ws-main-wrapper"
                data-toggle="ws-offcanvas-nav-active">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php echo $myclanname ?></a>
        </div>
    </div>
</div>

<div class="ws-main-wrapper">
    <div class="container">
        <div class="row">
            <nav class="ws-offcanvas-nav col-sm-3 col-md-3 col-md-3">
                <?php include("navigation.php"); ?>
            </nav>

            <div class="col-xs-12 col-sm-9 col-md-6">
                <?php
                if (!isset($site)) {
                    $site = "news";
                }
                $invalide = array('\\', '/', '/\/', ':', '.');
                $site = str_replace($invalide, ' ', $site);
                if (!file_exists($site . ".php")) {
                    $site = "news";
                }
                include($site . ".php");
                ?>
            </div>

            <aside class="hidden-xs hidden-sm col-md-3">
                <!-- login include -->
                <h3><?php echo $index_language[ 'login' ]; ?></h3>
                <?php include("login.php"); ?>

                <h3><?php echo $index_language[ 'topics' ]; ?></h3>
                <?php include("latesttopics.php"); ?>

                <h3><?php echo $index_language[ 'hotest_news' ]; ?></h3>
                <?php include("sc_topnews.php"); ?>

                <h3><?php echo $index_language[ 'latest_news' ]; ?></h3>
                <?php include("sc_headlines.php"); ?>

                <h3><?php echo $index_language[ 'squads' ]; ?></h3>
                <?php include("sc_squads.php"); ?>

                <h3><?php echo $index_language[ 'matches' ]; ?></h3>
                <?php include("sc_results.php"); ?>

                <h3><?php echo $index_language[ 'demos' ]; ?></h3>
                <?php include("sc_demos.php"); ?>

                <h3><?php echo $index_language[ 'upcoming_events' ]; ?></h3>
                <?php include("sc_upcoming.php"); ?>

                <h3><?php echo $index_language[ 'shoutbox' ]; ?></h3>
                <?php include("shoutbox.php"); ?>

                <h3><?php echo $index_language[ 'newsletter' ]; ?></h3>
                <?php include("sc_newsletter.php"); ?>

                <h3><?php echo $index_language[ 'statistics' ]; ?></h3>
                <?php include("counter.php"); ?>
            </aside>
        </div>
    </div>
</div>
<?php foreach ($components['js'] as $component) {
    echo '<script src="' . $component . '"></script>';
}
?>
<script>
    webshim.setOptions('basePath', 'components/webshim/js-webshim/minified/shims/');
    //request the features you need:
    webshim.setOptions(
        "forms-ext",
        {
            replaceUI: false,
            types: "date time datetime-local"
        }
    );
    webshim.polyfill('forms forms-ext');
</script>
<script src="js/bbcode.js" type="text/javascript"></script>
</body>
</html>
