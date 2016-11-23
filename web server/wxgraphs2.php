<?php
############################################################################
# A Project of TNET Services, Inc. and Saratoga-Weather.org (Canada/World-ML template set)
############################################################################
#
#   Project:    Sample Included Website Design
#   Module:     sample.php
#   Purpose:    Sample Page
#   Authors:    Kevin W. Reed <kreed@tnet.com>
#               TNET Services, Inc.
#
#   Copyright:  (c) 1992-2007 Copyright TNET Services, Inc.
############################################################################
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA
############################################################################
#   This document uses Tab 4 Settings
############################################################################
//Version 1.01 - 9-Aug-2011 - added Meteohub support
//Version 1.02 - 24-Mar-2012 - added WeatherCat support
//Version 1.03 - 03-Jul-2012 - added wview support
require_once("Settings.php");
require_once("common.php");
############################################################################
$useUTF8 = false;   // force this page to convert language files to UTF8 for display
$TITLE= $SITE['organ'] . " - " . langtransstr("Trend Graphs");
$showGizmo = true;  // set to false to exclude the gizmo
include("top.php");
############################################################################
?>
    <script src="/scripts/jquery/jquery-1.11.3.min.js"></script>
    <script src="/scripts/highcharts/highstock.js"></script>
    <script src="/scripts/highcharts/highcharts-more.js"></script>
    <script src="/scripts/highcharts/exporting.js" type="text/javascript"></script>
    <script src="/scripts/js/weewxtheme.js" type="text/javascript"></script>
    <script src="/scripts/js/saratogaplots.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function() {
            //Get references to links on the page
            var w = document.getElementById("seven_days");
            var y = document.getElementById("calendar_year");

            weekly();

            // Set code to run to display correct plots when the link is clicked
            // by assigning a function to "onclick"
            w.onclick = function() {
                document.getElementById("plottitle").innerHTML="Last Seven Days";
                document.getElementById("plotdesc").innerHTML="These graphs plot the recorded weather observations at this station over the last seven days. The time period displayed by the graph can be changed by using the Zoom buttons, the navigation scrollbar or by clicking and dragging on the graph itself.";
                weekly();
                return false;
            }
            
            y.onclick = function() {
                document.getElementById("plottitle").innerHTML="Last Calendar Year";
                document.getElementById("plotdesc").innerHTML="These graphs plot aggregated weather observations recorded at this station over the last calendar year. The aggregates used  (maximum, minimum, average or sum) are based on a 24 hour day from midnight to midnight. The time period displayed by the graph can be changed by using the Zoom buttons, the navigation scrollbar or by clicking and dragging on the graph itself. Note that for displays over a long period some further grouping of data into week periods may occur, in such cases the 'tooltip' will indicate the the grouping period used.";
                yearly();
                return false;
            }
        }
    </script>
</head>
<body>
<?php
############################################################################
include("header.php");
############################################################################
include("menubar.php");
############################################################################
$graphImageDir = './';
if(isset($SITE['graphImageDir'])) {$graphImageDir = $SITE['graphImageDir']; }
?>

<div id="main-copy">

    <h1><?php langtrans('Trend Graphs'); ?></h1>
    <br/>
    <?php if($SITE['WXsoftware'] <> '') { // software is defined ?>
        <?php print langtrans('Data generated by')." ".$SITE['WXsoftwareLongName']." "; ?>
        <?php if(isset($swversion)) {echo " (".$swversion.")";} ?>
    <?php } else { // software not defined yet ?>
        <p>&nbsp;</p>
        <p>Weather software not specified in configuration.</p>
    <?php } // end software not defined yet ?>
    <hr id="snippets-1" />

    <?php $WWgraphDescs = array(
        'w' => 'Seven_Days',
        'y' => 'Calendar_Year',
    );
    $WWgraphIdx = 'w';  // default is weekly set
    if(isset($_REQUEST['graph'])) { // check out selection
        $req = strtolower($_REQUEST['graph']);
        foreach ($WWgraphDescs as $i => $v) {
            if ($req == $i) {
                $WWgraphIdx = $i;  // default is 7-day set
                break;
            }
        }
    }
    // generate the links for the available periods to display
    print "<p style=\"text-align: center\">";
    foreach ($WWgraphDescs as $i => $v) {
        print "<a id=\"".strtolower($v)."\" href=\"?graph=".$i."\">".langtransstr(str_replace("_", " ", $v))."</a>&nbsp;&nbsp;";
    }
    print "</p>\n"; ?>
    <h3><span id="plottitle">Last Seven Days</span></h3>
    <p><span id="plotdesc">These graphs plot the recorded weather observations at this station over the last seven days. The time period displayed by the graph can be changed by using the zoom buttons, the navigation scrollbar or by clicking and dragging on the graph itself.</span></p>
    <div id="temperatureplot" style="width:99%; height:435px;"></div>
    <br />
    <div id="windchillplot" style="width:99%; height:435px;"></div>
    <br />
    <div id="humidityplot" style="width:99%; height:435px;"></div>
    <br />
    <div id="barometerplot" style="width:99%; height:435px;"></div>
    <br />
    <div id="windplot" style="width:99%; height:435px;"></div>
    <br />
    <div id="winddirplot" style="width:99%; height:435px;"></div>
    <br />
    <div id="rainplot" style="width:99%; height:435px;"></div>
    <br />
    <?php // figure out to display solar and/or UV based on site settings
    if($SITE['SOLAR'] and $SITE['UV']) { // have both sensors ?>
        <div id="radiationplot" style="width:99%; height:435px;"></div>
        <br />
        <div id="uvplot" style="width:99%; height:435px;"></div>
    <?php } elseif ($SITE['SOLAR']) { ?>
        <div id="radiationplot" style="width:99%; height:435px;"></div>
    <?php } elseif ($SITE['UV']) { ?>
        <div id="uvplot" style="width:99%; height:435px;"></div>
    <?php } // end solar/uv selection ?>

</div><!-- end main-copy -->

<?php
############################################################################
include("footer.php");
############################################################################
# End of Page
############################################################################
?>