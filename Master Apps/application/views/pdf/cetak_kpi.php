<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
		<style>
			html{
				font-size: 5px;
			}

			body{
				font-size: 10px;
			}
		</style>
		<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.bar.order.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.resize.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.stack.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.text.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/canvas2image.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/base64.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/flot/html2canvas.js"></script>

	</head>
	<body>
		<div class="row text-center">
			<img src="<?php echo base_url("assets/img/kop_surat.jpg"); ?>" alt="">
		</div>		


		<div id="kpi" style="width:500px;height:300px;visibility:visible"></div>
		

		<script type="text/javascript">
		(function ($) {
			var i = 0
			var series = [{
				data: [
				['1', 0.00],
				['2', 0.00],
				['3', 0.00],
				['4', 0.00],
				['5', 0.00],
				['6', 0.00],
				['7', 0.00],
				['8', 0.00],
				['9', 0.00],
				['10', 0.00],
				['11', 0.00],
				['12', 0.00]
				],
				label: 'KPI Tahun Ini (%)'
			}];


			var options = {
				xaxis: {
					ticks: [
					['1', 'Jan'],
					['2', 'Feb'],
					['3', 'Mar'],
					['4', 'Apr'],
					['5', 'Mei'],
					['6', 'Juni'],
					['7', 'Juli'],
					['8', 'Agust'],
					['9', 'Sept'],
					['10', 'Okt'],
					['11', 'Nov'],
					['12', 'Des']
					]
				},
				series: {
					lines: {
						show: true,
						barWidth: .9,
						align: "center"
					},
					stack: 0
				}
			};

			$.plot("#kpi", series, options);
		})(jQuery);

		$(function(){
			function saveFlotGraphAsPNG(placeholderID, targetID) {

	          var divobj = document.getElementById(placeholderID);

	          var oImg = Canvas2Image.saveAsPNG(divobj.childNodes[0], true);

	          if (!oImg) {
	              alert("Sorry, this browser is not capable of saving PNG files!");
	              return false;
	          }

	          oImg.id = "canvasimage";
	          
	          console.log(oImg);
	          document.getElementById(targetID).removeChild(document.getElementById(targetID).childNodes[0]);
	          document.getElementById(targetID).appendChild(oImg);


	        }

	         	
	        $('.tes').html('ewe enak ewenak');

		});


		</script>			
	<div id="main" style="margin-top:20px;"/>
	</div>
	</body> 

	<script>
	$(function() { 
	    
	        html2canvas($("#kpi"), {
	            onrendered: function(canvas) {
	                var img = Canvas2Image.saveAsPNG(canvas,true); 
	                console.log(img);
	                $("#main").append(img);
	            }
	        });
	}); 
	</script>
	
	
</html>