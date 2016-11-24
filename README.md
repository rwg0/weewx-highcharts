# Highcharts for weewx extension #

## Description ##

The *Highcharts for weewx* extension provides a JSON data feed to support weekly and yearly observation plots using Highcharts. A sample HTML page and the JavaScript necessary to render the Highcharts plots is also included in the [*Highcharts for weewx* repositry](https://github.com/gjr80/weewx-highcharts).

## Pre-Requisites ##

The *Highcharts for weewx* extension requires *weewx v3.4.0* or greater.  

## Installation ##

The preferred method to install the Highcharts for weewx extension is to use the weewx *wee_extension* utility. To install the Highcharts for weewx extension using the weewx *wee_extension* utility:

**Note:** In the following code snippets the symbolic name *$DOWNLOAD_ROOT* is the path to the directory containing the downloaded Highcharts for weewx extension.

1.  Download the Highcharts for weewx extension from the Highcharts for weewx [releases page](https://github.com/gjr80/weewx-highcharts/releases) into a directory accessible from the weewx machine.

	    wget -P $DOWNLOAD_ROOT https://github.com/gjr80/weewx-highcharts/releases/download/v0.1.0/hfw-0.1.0.tar.gz

2.  Stop weewx:

	    sudo /etc/init.d/weewx stop

	or

	    sudo service weewx stop

3.  Install the Highcharts for weewx extension downloaded at step 1 using the *wee_extension* utility:

    	wee_extension --install=$DOWNLOAD_ROOT/hfw-0.1.0.tar.gz

    This will result in output similar to the following:

        Request to install '/var/tmp/hfw-0.1.0.tar.gz'
        Extracting from tar archive /var/tmp/hfw-0.1.0.tar.gz
        Saving installer file to /home/weewx/bin/user/installer/Hfw
        Saved configuration dictionary. Backup copy at /home/weewx/weewx.conf.20161123124410
        Finished installing extension '/var/tmp/hfw-0.1.0.tar.gz'

4. Start weewx:

	    sudo /etc/init.d/weewx start

	or

	    sudo service weewx start

This will result in the Highcharts for weewx JSON data files being generated during each report generation cycle. A default installation will resulting in the generated JSON data files being placed in the *$HTML_ROOT/json* directory. The Highcharts for weewx installation can be further customized (eg units of measure, file locations etc) by referring to the Highcharts for weewx wiki.

**Note:** The symbolic directory *$HTML\_ROOT* will depend on your installation and *weewx.conf*/*skin.conf* settings. A default weewx install will use */var/www/html* or */home/weewx/public_html*.

## Support ###

General support issues may be raised in the Google Groups [weewx-user forum](https://groups.google.com/group/weewx-user "Google Groups weewx-user forum"). Specific bugs in the Highcharts for weewx extension code should be the subject of a new issue raised via the [Issues Page](https://github.com/gjr80/weewx-highcharts/issues "Highcharts for weewx extension Issues").
 
## Licensing ##

The *Highcharts for weewx* extension is licensed under the [GNU Public License v3](https://github.com/gjr80/weewx-highcharts/blob/master/LICENSE "Highcharts for weewx extension License").
