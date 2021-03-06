<?
require_once('inc/db.php');

$profileId = 0;
if (isset($_REQUEST['profileId'])) {
	$profileId = $_REQUEST['profileId'];
}

$startDate = '';
if (isset($_REQUEST['startDate'])) {
	$startDate = $_REQUEST['startDate'];
}

$endDate = '';
if (isset($_REQUEST['endDate'])) {
	$endDate = $_REQUEST['endDate'];
}

$interval = '';
if (isset($_REQUEST['interval'])) {
	$interval = $_REQUEST['interval'];
}

$stats = getPageStat($profileId, $startDate, $endDate, $interval);

?>
<chart caption='Page Views &amp; Visitors' lineThickness='4' showValues='0' anchorRadius='4' anchorBgAlpha='50' showAlternateVGridColor='1' animation='1' scrollToEnd='1' showLegend='1' chartTopMargin='5' chartBottomMargin='10' chartLeftMargin='5' chartRightMargin='10' captionPadding='5' palette='3' setAdaptiveYMin='1' baseFontSize='9' baseFont='Lucida Grande, Arial' valuePadding='5' connectNullData='1'>
<categories >
<? for ($i = 0; $i < sizeof($stats); $i++) { ?>
<category label='<?=$stats[$i]['period']?>' />
<? } ?>
</categories>
<dataset seriesName='Page Views' color='6666FF'>
<? for ($i = 0; $i < sizeof($stats); $i++) { ?>
<set value='<?=emptyIfZero(round($stats[$i]['pageview']))?>' />
<? } ?>
</dataset>
<dataset seriesName='Visitors'>
<? for ($i = 0; $i < sizeof($stats); $i++) { ?>
<set value='<?=emptyIfZero(round($stats[$i]['visit']))?>' />
<? } ?>
</dataset>

<!--
<trendlines>
      <line startValue='2000' color='91C728' displayValue='Target' showOnTop='0'/>
   </trendlines>
-->
   <styles>

<definition>
<style name='CaptionStyle' type='font' font='Lucida Grande, Arial' size='12'/> 
      </definition>

      <application>
         <apply toObject='Caption' styles='CaptionStyle' />
      </application>   
         </styles>
</chart>