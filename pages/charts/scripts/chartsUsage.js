
/*function processData(data) {
        var lines = data.split(/\r\n|\n/);

        //Set up the data arrays
        var time = [];
        var data1 = [];
        var data2 = [];
        var data3 = [];
		
		var dataPoints=[];

        var headings = lines[0].split(','); // Splice up the first row to get the headings
		//console.log(headings)
        for (var j=1; j<lines.length-1; j++) {
        var values = lines[j].split(','); // Split up the comma seperated values
           // We read the key,1st, 2nd and 3rd rows 
           time.push(values[1]); // Read in as string
		   //console.log(values);
		  // console.log(time);
           // Recommended to read in as float, since we'll be doing some operations on this later.
           data1.push(parseFloat(values[2])); 
          
		
		
		
        }
		
		for(var i=0;i<time.length;i++)
		{
		dataPoints.push({label:time[i],y:data1[i]});
		}
			

   
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
	};

   Chart.types.Line.extend({
    name: "LineAlt",
    draw: function () {
        Chart.types.Line.prototype.draw.apply(this, arguments);
        
        var ctx = this.chart.ctx;
        ctx.save();
        // text alignment and color
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";
        ctx.fillStyle = this.options.scaleFontColor;
        // position
        var x = this.scale.xScalePaddingLeft * 0.4;
        var y = this.chart.height / 2;
        // change origin
        ctx.translate(x, y)
        // rotate text
        ctx.rotate(-90 * Math.PI / 180);
        ctx.fillText(this.datasets[0].label, 0, 0);
        ctx.restore();
    }
});
    var ctx = document.getElementById("usageline").getContext("2d");
	//console.log(lines[1][1]);
	var dData = function() {
  return Math.round(Math.random() * 90) + 10
};
    var data = {
	
      labels: [dData(), "02:00",  "04:00",  "06:00", 
	  "08:00",  "10:00", "12:00", "14:00", "16:00", "18:00", "20:00","22:00"],
      datasets: [{
        label: "Energy Usage Stats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#009FDA",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [0.081, 0.077, 0.080, 0.091,0.100,0.200,0.210,0.270,0.170,0.170,0.090,0.070]
		
      },
	  ]
    };
    var MyNewChart = new Chart(ctx).Line(data, {
	scaleLabel: "<%=value%>"
	});
	*/

	/* Chart.types.Line.extend({
    name: "LineAlt",
    draw: function () {
        Chart.types.Line.prototype.draw.apply(this, arguments);
        
        var ctx = this.chart.ctx;
        ctx.save();
        // text alignment and color
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";
        ctx.fillStyle = this.options.scaleFontColor;
        // position
        var x = this.scale.xScalePaddingLeft * 0.4;
        var y = this.chart.height / 2;
        // change origin
        ctx.translate(x, y)
        // rotate text
        ctx.rotate(-90 * Math.PI / 180);
        ctx.fillText(this.datasets[0].label, 0, 0);
        ctx.restore();
    }
});
    var ctx = document.getElementById("mChart").getContext("2d");
	//console.log(lines[1][1]);
	var dData = function() {
  return Math.round(Math.random() * 90) + 10
};
    var data = {
	
      labels: ["02:00",  "04:00",  "06:00", 
	  "08:00",  "10:00", "12:00", "14:00", "16:00", "18:00", "20:00","22:00"],
      datasets: [{
        label: "Energy Usage Stats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#009FDA",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [0.081, 0.077, 0.080, 0.091,0.100,0.200,0.210,0.270,0.170,0.170,0.090,0.070]
		
      },
	  ]
    };
    var MyNewChart = new Chart(ctx).Line(data, {
	scaleLabel: "<%=value%>"
	});
*/	/*
	 Chart.types.Line.extend({
    name: "LineAlt",
    draw: function () {
        Chart.types.Line.prototype.draw.apply(this, arguments);
        
        var ctx = this.chart.ctx;
        ctx.save();
        // text alignment and color
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";
        ctx.fillStyle = this.options.scaleFontColor;
        // position
        var x = this.scale.xScalePaddingLeft * 0.4;
        var y = this.chart.height / 2;
        // change origin
        ctx.translate(x, y)
        // rotate text
        ctx.rotate(-90 * Math.PI / 180);
        ctx.fillText(this.datasets[0].label, 0, 0);
        ctx.restore();
    }
});
    var ctx = document.getElementById("dChart").getContext("2d");
	//console.log(lines[1][1]);
	var dData = function() {
  return Math.round(Math.random() * 90) + 10
};
    var data = {
	
      labels: [dData(), "02:00",  "04:00",  "06:00", 
	  "08:00",  "10:00", "12:00", "14:00", "16:00", "18:00", "20:00","22:00"],
      datasets: [{
        label: "Energy Usage Stats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#009FDA",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [0.081, 0.077, 0.080, 0.091,0.100,0.200,0.210,0.270,0.170,0.170,0.090,0.070]
		
      },
	  ]
    };
    var MyNewChart = new Chart(ctx).Line(data, {
	scaleLabel: "<%=value%>"
	});*/