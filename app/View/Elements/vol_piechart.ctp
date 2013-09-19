<?php $array = $this -> requestAction(array(
 'controller' => 'loghours',
 'action' => 'volunteerPieData'
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

		var formatter = new google.visualization.NumberFormat({
			suffix: ' hrs',
			fractionDigits: 0,
		});
		formatter.format(data, 1);
		
        var options = {
          title: 'Log Hour for different Categories',         		
    	 /* is3D: true,*/
		  pieSliceText:'value',
		  pieResidueSliceLabel:'Other'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
</script>
<div id="piechart" style="width:100%;height:400px"></div>