var displayDay;
 var peakUse;
 var peakUseHour;
	
       

    $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processData(data); }
    });

	
	function processData(data) {
		//console.log(data)
		time=[];
		data1=[];
		 //Set up the data arrays
        
      
		var hour;
		var day;
		var values=[];
		var dataPoints=[];
		//var date=[];
		
		var newData =[];
		var currentDay;
		
		var total=0;	
		
		var lines = data.split(/\r\n|\n\s+/);
		//console.log(data);
       
        var headings = lines[0].split(','); // Splice up the first row to get the headings
		//console.log(lines);
		peakUse = 0;
		peakUseHour=0;
		total=0;
		
        for (var j=1; j<lines.length-1; j++) {
			
        values.push(lines[j].split(',')); // Split up the comma seperated values
           // We read the key,1st, 2nd and 3rd rows 
		}
		
		if(displayDay ==undefined){
		displayDay = calculateDisplayDay(values[0][1]);
		
		}
		//displayDay = displayDay.toDateString();
		var dayChange=document.getElementById('dayString').innerHTML;
		var peakUseHour;
		for(var k=0;k<values.length;k++){
			
			
			var date = values[k][1].toString();
			date=convertToDate(date);
			date = date.toDateString();
			//console.log(date);
			//console.log(date);
			if(date == dayChange){
				//console.log(peakUse);
				if(peakUse==0){
				peakUse = values[k][2];
				 peakHour=values[k][1].toString();
				peakUseHour = convertToHour(peakHour);
			//	console.log(peakUseHour);
				//console.log(peakUseHour);
				
				}
				var currentNumber=parseFloat(values[k][2]);
				total+=currentNumber;
				//console.log(total);
				
			//console.log(peakUse);
			if(values[k][2] > peakUse){
				peakUse = values[k][2];
				 peakHour=values[k][1].toString();
				peakUseHour = convertToHour(peakHour);
				//console.log(peakUse);
			}
				data1.push(parseFloat(values[k][2]));
			    hour=values[k][1].toString();
				hour = convertToHour(hour);
				time.push(hour);
				
		}

			
			dataPoints.push({label:time[k],y:data1[k]});
			//console.log(dataPoints.length);
		}
		
		//console.log(dataPoints);
		
		//console.log(dataPoints);
   
    var linedata = {
	
      labels: time,
      datasets: [{
        label: "Energy Usage Stats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#009FDA",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: data1

		
      },
	  ]
    };	
	
	var canvas_html = '<canvas id="usageLine" height="400px;"></canvas>';
	
	   $('#usageLine').html(canvas_html);
	var totalUse = document.getElementById('overallUsage').innerHTML =total.toFixed(2);
	var useLabel= document.getElementById('peakUseText').innerHTML =peakUse;
	var timeLabel= document.getElementById('peakUseTime').innerHTML =peakUseHour;
	var ctx = document.getElementById('usageLine').getContext("2d");
	//G_vmlCanvasManager.initElement(ctx);
    var usageline = new Chart(ctx).Line(linedata, {
    responsive : true,
	pointHitDetectionRadius: 3,
	
	
	
	});
	//console.log("OVER");
	time=[];
	data1=[];
	//console.log(time.length);
	}
	
	function calculateDisplayDay(datetoDisplay){
	
		//console.log(datetoDisplay);
		
		
		var displayDate = datetoDisplay.toString();
		var displayDay = new Date();
		displayDay = convertToDate(displayDate);
		//console.log(displayDate.toDateString());
		var year   = displayDate.substring(6,10);
		var month  = displayDate.substring(3,5);
		var day  = displayDate.substring(0,2);
		var hour = displayDate.substring(11,13);
		var minute= displayDate.substring(14,16);
		var full = (year+"-"+month+"-"+day+" "+hour+":"+minute);
		var fullDisplayDate = new Date(full.replace(/-/g,"/"));
	//	var testFull = new Date (2012, 11, 2, 19, 30, 0)
		//console.log(full);
		
		var date = new Date(full);
		var currentDate = new Date();
		
		//console.log(newFull.toDateString());
		
		var dayLabel= document.getElementById('dayString').innerHTML =fullDisplayDate.toDateString();
		
		return fullDisplayDate;
	}
	
	function convertToDate(date){
		
	var displayDate = date.toString();
		
		var year = displayDate.substring(6,10);
		var month = displayDate.substring(3,5);
		var day = displayDate.substring(0,2);
		var hour = displayDate.substring(11,13);
		var minute= displayDate.substring(14,16);
		var full = (year+"-"+month+"-"+day+" "+hour+":"+minute);
		var dateReturn = new Date(full.replace(/-/g,"/"));
		
		return dateReturn;
		
		
	}
	
	function convertToHour(hour){
		
		var displayDate = hour.toString();
		
		var year = displayDate.substring(6,10);
		var month = displayDate.substring(3,5);
		var day = displayDate.substring(0,2);
		var hour = displayDate.substring(11,13);
		var minute= displayDate.substring(14,16);
		
		var fullTime = (hour+":"+minute);
		//console.log(hour);
		return fullTime;
		
	}

		
	
    $('#changeDate').click(function(){
		var text = dayString.innerHTML;
		var result= new Date(text);
		
		result.setDate(result.getDate()+1);
		//
		calculateDisplayDay(result);
		dayLabel= document.getElementById('dayString').innerHTML =result.toDateString();
		
		  $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processData(data); }
    });
    });
	
	$('#changeDateBack').click(function(){
		var text = dayString.innerHTML;
      
	  
		
		var result= new Date(text);
		
		result.setDate(result.getDate()-1);
		//
		calculateDisplayDay(result);
		dayLabel= document.getElementById('dayString').innerHTML =result.toDateString();
		
		  $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processData(data); }
    });
    });