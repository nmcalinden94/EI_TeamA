 var displayWeek;
 var displayWeekEnd;
 var weekDays=[];
 
 $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processDataWeekly(data); }
    });
	
	function processDataWeekly(data) {
		weekDays=[];
		var dayNames = ["Sunday", "Monday", "Tuesday","Wednesday", "Thursday", "Friday","Saturday"
			];
		
		var wvalues=[];
		var months=[];
		var currentNumber;
		var ttotal=0;
		var total=0;
		var totalWeek=[];
		var test=0;
		var wdataPoints=[];
		//console.log(data);
       var wLines = data.split(/\r\n|\n\s+/);
    var headings = wLines[0].split(','); // Splice up the first row to get the headings
		//console.log(lines);
		for (var j=1; j<wLines.length-1; j++) {
			
        wvalues.push(wLines[j].split(',')); // Split up the comma seperated values
           // We read the key,1st, 2nd and 3rd rows 
		}
		
		if(displayWeek ==undefined){
			displayWeek = calculateStartDisplayWeek(wvalues[0][1]);
			displayWeekEnd= calculateEndDisplayWeek(wvalues[0][1]);
		}
		
		
		
		
		//console.log(displayWeek+"+"+displayWeekEnd);
		
		var startWeek=document.getElementById('weekString').innerHTML;
		var endWeek=document.getElementById('weekEndString').innerHTML;
		var newdate;
		var newdateDay;
		//var startWeekDay =convertToDate(startWeek);
		//startWeekDay = startWeekDay.getDay();
		//startWeekDay=startWeekDay.toDateString();
		 var startWeekDay = new Date(startWeek);
		var endWeekDay = new Date(endWeek);
		endWeekDay.setDate(endWeekDay.getDate()+1);
		//console.log(endWeekDay);
		for(var k=0;k<wvalues.length;k++){
			
			var date = wvalues[k][1].toString();
			date=convertToDate(date);
			date = new Date(date);
			var dateDay = date.getDate();
			
			currentNumber=0;
			//console.log("OUTPUT");
			currentNumber=parseFloat(wvalues[k][2]);
			
			
			
			if(date <endWeekDay && date >=startWeekDay) {
				//console.log(date);
				//console.log("TESTING");
				
				
				if(newdate ==undefined){
					
					newdate = wvalues[k][1].toString();
				newdate=convertToDate(newdate);
				newdate = new Date(newdate);
			 newdateDay = newdate.getDate();
			// console.log(newdateDay);
				}
				
				
				
				currentNumber=0;
			//console.log("OUTPUT");
			currentNumber=parseFloat(wvalues[k][2]);
			
			total+=currentNumber;
			ttotal=total.toFixed(3);
				
				
				if(dateDay != newdateDay)
				{
					if(test==0){
				var newCurrentNumber = currentNumber;
				test=1;
					}
					
					var days = newdate.getDay();
					//console.log(days);
					var d=dayNames[days];
					
					weekDays.push(d);
				//	console.log(ttotal);
					totalWeek.push(ttotal);
					//totalWeek.push(ttotal);
					ttotal=0;
					total=0;
					//console.log(totalWeek);
				}
				
				newdate = wvalues[k][1].toString();
				newdate=convertToDate(newdate);
				newdate = new Date(newdate);
			 newdateDay = newdate.getDate();
			}

			if(newCurrentNumber!=0 && totalWeek[0]>0){
					//console.log(totalMonth[0]);
					var newTest=totalWeek[0];
				//	console.log(currentNumber);
					//console.log(newTest);
					//console.log(newCurrentNumber);
					var newEntry = newTest - newCurrentNumber;
					newEntry= newEntry.toFixed(3);
					//var newTest1=totalWeek[1];
					//console.log(totalWeek[1]);
					totalWeek[0]=newEntry;
					//console.log(newEntry);
					newCurrentNumber=0;
					//var to=totalMonth[0] - currentNumber;
					//console.log(to);
				}
				
				//console.log(totalWeek);
				
			wdataPoints.push({label:weekDays[k],y:totalWeek[k]});			
			
				
				
				//console.log("TESTING")
								
		
	
			
			
			

			
			//wdataPoints.push({label:totalMonth[k],y:months[k]});
		}
		
		 var linedata = {
	
      labels: weekDays,
      datasets: [{
        label: "Energy Usage Stats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#009FDA",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: totalWeek

		
      },
	  ]
    };	
	
	
	var ctx = document.getElementById('wChart').getContext("2d");
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
	
	function calculateStartDisplayWeek(datetoDisplay){
	
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
		
		var weekStartLabel= document.getElementById('weekString').innerHTML =fullDisplayDate.toDateString();
		//console.log(dayLabel);
		return fullDisplayDate;
	}
	
	
	
	function calculateEndDisplayWeek(datetoDisplay){
	
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
		var fullDisplayDateEnd = new Date(full.replace(/-/g,"/"));
		fullDisplayDateEnd.setDate(fullDisplayDateEnd.getDate()+7);
		
	//	var testFull = new Date (2012, 11, 2, 19, 30, 0)
		//console.log(full);
		
		var date = new Date(full);
		var currentDate = new Date();
		
		//console.log(newFull.toDateString());
		
		var endWeekLabel= document.getElementById('weekEndString').innerHTML =fullDisplayDateEnd.toDateString();
		//console.log(dayLabel);
		return fullDisplayDateEnd;
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
		
		
		$('#changeWeek').click(function(){
		var text = weekString.innerHTML;
		var text2 = weekEndString.innerHTML;
		var result= new Date(text);
		var result2=new Date(text2);
		
		result.setDate(result.getDate()+7);
		result2.setDate(result2.getDate()+7);
		//
		calculateStartDisplayWeek(result);
		calculateEndDisplayWeek(result2);
		weekStartLabel= document.getElementById('weekString').innerHTML =result.toDateString();
		endWeekLabel= document.getElementById('weekEndString').innerHTML =result2.toDateString();
		
		  $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processDataWeekly(data); }
    });
    });
	
	$('#changeWeekBack').click(function(){
		var text = weekString.innerHTML;
		var text2 = weekEndString.innerHTML;
		var result= new Date(text);
		var result2=new Date(text2);
		
		result.setDate(result.getDate()-7);
		result2.setDate(result2.getDate()-7);
		//
		calculateStartDisplayWeek(result);
		calculateEndDisplayWeek(result2);
		weekStartLabel= document.getElementById('weekString').innerHTML =result.toDateString();
		endWeekLabel= document.getElementById('weekEndString').innerHTML =result2.toDateString();
		
		  $.ajax({
        type: "GET",
        url: "csv/newTest.csv",
        dataType: "text",
        success: function (data) { processDataWeekly(data); }
    });
    });