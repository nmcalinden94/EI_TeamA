
$(function () {

var chartDataStore = Ext.create("Ext.data.ArrayStore", {
  storeId: "chartData",
  fields: [{
      name: "energy",
      type: "string"
    },
    "", {
      name: "value1",
      type: "integer"
    },
  ],
  data: [
    ["July", "", 4632],
    ["August", "", 4672],
    ["September", "", 4628],
    ["October", "", 4632],
    ["November", "", 4632],
    ["December", "", 4632]
  ]

});

var win = Ext.create("Ext.chart.Chart", {
  width: 600,
  height: 400,
  hidden: false,
  title: "Total Energy used graph",
  renderTo: "energyPerHourChart",
  layout: "fit",
  style: "background:#fff",
  animate: true,
  store: chartDataStore,
  shadow: true,
  theme: "Category1",
  legend: {
    position: "bottom"
  },
  axes: [{
    type: "Numeric",
    minimum: 1000,
    position: "left",
    fields: ["value1", "value2"],
    title: "Total Energy (KWH)",
    minorTickSteps: 1,
    grid: {
      odd: {
        opacity: 1,
        fill: "#ffffff",
        stroke: "#009FDA",
        "stroke-width": 0.5
      }
    }
  }, {
    type: "Category",
    position: "bottom",
    fields: ["energy"],
    title: "Months"
  }],
  series: [{
      type: "line",
      highlight: {
        size: 7,
        radius: 7
      },
      axis: "left",
      smooth: true,
      xField: "energy",
      yField: "value1",
      title: "SU Shop",
      markerConfig: {
        type: "cross",
        size: 4,
        radius: 4,
        fill: "#009FDA",
        "stroke-width": 1
      }
  }]

});