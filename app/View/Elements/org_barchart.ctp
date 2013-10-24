<?php $array = $this -> requestAction(array(
 'controller' => 'loghours',
 'action' => 'OrganizationAgeChartData'
));
?>
<script type="text/javascript">	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
		  <?php
		  $rec_count = 0;
		  foreach($array as $reco){           
		  ?>
		  [<?php for($countIndex = 0 ; $countIndex<count($reco);$countIndex++){
			 if($rec_count == 0){
			    echo "'".$reco[$countIndex]."'";  
			}else{
			  if($countIndex==0){
		            echo "'".$reco[$countIndex]."'";                    
					    }
					    else{
		            echo $reco[$countIndex]; 
					    }
		          }
			  if($countIndex<count($reco)-1)echo ',';
		      }	  
		  ?>],
		 <?php		 
		  $rec_count++;		
		  }
		  ?>
		  ]);

        var options = {
          title: 'AGE DISTRIBUTION',
          hAxis: {title: 'AGE', titleTextStyle: {color: '#F97F04'},textStyle:{fontName:"'Trebuchet MS', Arial, Helvetica, sans-serif", fontSize:11}},
		  vAxis: {title: 'HRS', titleTextStyle: {color: '#F97F04'},textStyle:{fontName:"'Trebuchet MS', Arial, Helvetica, sans-serif", fontSize:11}},		 
		  colors:['#F97F04'],	 
		 
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
        chart.draw(data, options);
      }
$(window).resize(function(){
	drawChart2();
	//alert('test');
});
</script>
    <div id="bar_chart" style="width:100%;"></div>