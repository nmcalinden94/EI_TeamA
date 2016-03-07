

 $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processDataMonthly(data); }
    });
	
	function processDataMonthly(data) {
		
		var monthNames = ["","January", "February", "March", "April", "May", "June",
			"July", "August", "September", "October", "November", "December"
			];
		var mvalues=[];
		var months=[];
		var total=0;
		var totalMonth=[];
		var ttotal=0;
		var dateMonth;
		var test=0;
		var currentDateMonth;
		var currentNumber=0;
		var mdataPoints=[];
		var date;
		var dm;
			var totalMonth=[];
		//console.log(data);
       var mLines = data.split(/\r\n|\n\s+/);
    var headings = mLines[0].split(','); // Splice up the first row to get the headings
		//console.log(lines);
		for (var j=1; j<mLines.length-1; j++) {
			
        mvalues.push(mLines[j].split(',')); // Split up the comma seperated values
           // We read the key,1st, 2nd and 3rd rows 
		}
		
		for(var k=0;k<mvalues.length-1;k++){
			//console.log("COM");
			if(mvalues[k][0] !=""){
			var currentDate = mvalues[k][1].toString();
			currentDate=convertToDate(currentDate);
			//console.log(currentDate.getMonth()+1);
			var currentDateMonth=currentDate.getMonth()+1;
		
			if(date == undefined){
			//console.log("UNED");
			date = mvalues[k][1].toString();
			date=convertToDate(date);
			dateMonth=date.getMonth()+1;
			}
			
			currentNumber=0;
			//console.log("OUTPUT");
			currentNumber=parseFloat(mvalues[k][2]);
			
			total+=currentNumber;
			ttotal=total.toFixed(3);
			
			
				
			if(dateMonth !=currentDateMonth){
				//console.log(dateMonth);
				//console.log(currentDateMonth);
				//console.log(date+ " " +ttotal);
				if(test==0){
				var newCurrentNumber = currentNumber;
				test=1;
			}
				var d=monthNames[dateMonth];
				//console.log(date+" "+ttotal);
				totalMonth.push(ttotal);
				
				//console.log(currentNumber);
				
				//console.log(ttotal);
				//console.log(totalMonth);
				ttotal=0;
				total=0;
				//console.log(mvalues[k][2]);
				months.push(d);
			}
			date = mvalues[k][1].toString();
			date=convertToDate(date);
			dateMonth=date.getMonth()+1;
			if(dateMonth!=currentDateMonth){	
			}
			
			if(newCurrentNumber!=0 && totalMonth[0]>0){
					//console.log(totalMonth[0]);
					var newTest=totalMonth[0];
					//console.log(newTest);
					//console.log(newCurrentNumber);
					var newEntry = newTest - newCurrentNumber;
					newEntry= newEntry.toFixed(3);
					totalMonth[0]=newEntry;
				//	console.log(newEntry);
					newCurrentNumber=0;
					//var to=totalMonth[0] - currentNumber;
					//console.log(to);
				}
			mdataPoints.push({label:months[k],y:totalMonth[k]});
			
			
		}
		
			
	}


		
		 var linedata = {
	
      labels: months,
      datasets: [{
        label: "Energy Usage Stats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#009FDA",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: totalMonth

		
      },
	  ]
    };	
	
	var ctx = document.getElementById('dChart').getContext("2d");
	//G_vmlCanvasManager.initElement(ctx);
    var usageline = new Chart(ctx).Line(linedata, {
    responsive : true
	
	
	});
	};

		//console.log(headings);		
		
	/*var totalUse = document.getElementById('overallUsage').innerHTML =total.toFixed(2);
	var useLabel= document.getElementById('peakUseText').innerHTML =peakUse;
	var timeLabel= document.getElementById('peakUseTime').innerHTML =peakUseHour;
	var ctx = document.getElementById('usageline').getContext("2d");
	//G_vmlCanvasManager.initElement(ctx);
    var usageline = new Chart(ctx).Line(linedata, {
    responsive : true
	
	
	});*/
	
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
		