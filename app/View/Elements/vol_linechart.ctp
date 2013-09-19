<?php $array = $this -> requestAction(array(
 'controller' => 'loghours',
 'action' => 'volunteerChartData'
));
?>
<script type="text/javascript">	  
		  google.load("visualization", "1", {packages:["corechart"]});
		  google.setOnLoadCallback(drawChart);
		  function drawChart() {
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
		          title: 'Hourly Report',			
			  vAxis: {gridlines:{color: '#1E4D6B',count:6}},
			  hAxis: {baseline:'automatic',minorGridlines:{color: '#1E4D6B',count:10},logScale:false},	 
			  pointSize : 8,			  
			};
	
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		  }	 
</script>
    <div id="chart_div" style="width:100%;"></div>