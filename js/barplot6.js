var yrange = [0,350];
var jindex;
var bgcolors = ['rgba(200,255,0,0.1)','rgba(0,255,200,0.1)'];

var outcomes = ["MI","CVA","VTE","PID","Ectopic"];
var outcome;

function updatePlots() {
  var plotData;
  for (i=0; i<outcomes.length; i++) {
    let outcome = outcomes[i];
    d3.csv("data/ContraceptiveRiskData" + outcome + ".csv", function(csvread) {
      plotData = choosePlotData(csvread, age, ht, smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
      plotBarplot(plotData,outcome);
    });
  };
}

function updateMultiPlots() {
  for (i=0; i<outcomes.length; i++) {
    let outcome = outcomes[i];
    d3.csv("data/ContraceptiveRiskData" + outcome + ".csv", function(csvread) {
      var plotDatas = [];
      var names
      if (SmokingYN) {
        plotDatas[0] = choosePlotData(csvread, age, ht, false, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[1] = choosePlotData(csvread, age, ht, true,  obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        names = ['non smokers','smokers'];
      } else if (HyptertensionYN) {
        plotDatas[0] = choosePlotData(csvread, age, false, smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[1] = choosePlotData(csvread, age, true,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        names = ['no hypertension','hypertension'];
      } else if (ObeseYN) {
        plotDatas[0] = choosePlotData(csvread, age, ht, smoking, false, sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[1] = choosePlotData(csvread, age, ht, smoking, true,  sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        names = ['not obese','obese'];
      } else if (Ages) {
        plotDatas[0] = choosePlotData(csvread, "15-19", ht, smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[1] = choosePlotData(csvread, "20-24", ht,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[2] = choosePlotData(csvread, "25-29", ht,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[3] = choosePlotData(csvread, "30-34", ht,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[4] = choosePlotData(csvread, "35-39", ht,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[5] = choosePlotData(csvread, "40-44", ht,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        plotDatas[6] = choosePlotData(csvread, "45-49", ht,  smoking, obesity,sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod);
        names = ['15-19','20-24','25-29','30-34','35-39','40-44','45-49'];
      }
      plotBarplotMultiple(plotDatas,outcome,names);
    });
  };
}

function plotBarplot(input,outcome) {
  var data = [{
    x: Object.keys(input),
    y: Object.values(input),
    type: 'bar',
    text: yValue,
    textposition: 'auto'
  }];
  if (outcome=='CVA' || outcome=='PID') {
    jindex = 0;
  } else {
    jindex = 1;
  }
  var layout = {
  	yaxis: {
  		range: yrange
  	},
    title: '<br />' + outcome,
    margin: {
      l: 50,
      r: 50,
      b: 90,
      t: 120,
      pad: 6
    },
    paper_bgcolor: bgcolors[jindex]
  };
  Plotly.newPlot("plot" + outcome,  data, layout, {displayModeBar: false, staticPlot: true});
}

function plotBarplotMultiple(inputs,outcome,names) {
  var data = [];
  for (var i = 0, len = inputs.length; i < len; i++) {
    var datai = {
      x: Object.keys(inputs[i]),
      y: Object.values(inputs[i]),
      type: 'bar',
      name: names[i],
      text: yValue,
      textposition: 'auto'
    };
    data[i] = datai;
  }
  if (outcome=='CVA' || outcome=='PID') {
    jindex = 0;
  } else {
    jindex = 1;
  }
  var layout = {
  	barmode: 'group',
    yaxis: {
      range: yrange
    },
    title: '<br />' + outcome,
    margin: {
      l: 50,
      r: 50,
      b: 90,
      t: 120,
      pad: 6
    },
    paper_bgcolor: bgcolors[jindex]
  };
  Plotly.newPlot("plot" + outcome,  data, layout, {displayModeBar: false, staticPlot: true});
}

function choosePlotData(input0, age, ht, smoking, obesity,
	sterilization,pill1,pill2,iud1,iud2,injection,implant,condom,withdrawl,nomethod) {
	var plotData 
	var ageIndex 
  var input = [];                                        // create empty array to hold copy

  for (var i = 0, len = input0.length; i < len; i++) {
    input[i] = {};                                       // empty object to hold properties added below
    for (var prop in input0[i]) {
        input[i][prop] = input0[i][prop];                // copy properties from input0 to input
    }
  }

	for (var i = input.length - 1; i >= 0; i--) {
		delete input[i]['Age'];                              // names are from Excel files and are used in plots
		delete input[i]['RF'];
		delete input[i]['Demographic Groups'];
		if (!sterilization) {
			delete input[i]['Sterilization']
		}
		if (!pill1) {
			delete input[i]['Pill_1']
		}
		if (!pill2) {
			delete input[i]['Pill_2']
		}
		if (!iud1) {
			delete input[i]['IUD_1']
		}
		if (!iud2) {
			delete input[i]['IUD_2']
		}
		if (!injection) {
			delete input[i]['3month_injection']
		}
		if (!implant) {
			delete input[i]['Implant']
		}
		if (!condom) {
			delete input[i]['Condom']
		}
		if (!withdrawl) {
			delete input[i]['Withdrawal']
		}
		if (!nomethod) {
			delete input[i]['No_method']
		}
	}
	
	switch(age) {
    case "15-19":
      ageIndex = 0;
      break;
    case "20-24":
      ageIndex = 1;
      break;
    case "25-29":
      ageIndex = 2;
      break;
    case "30-34":
      ageIndex = 3;
      break;
    case "35-39":
      ageIndex = 4;
      break;
    case "40-44":
      ageIndex = 5;
      break;
    case "45-49":
      ageIndex = 6;
      break; 
    default:
      break;
  }

  plotData = input[ageIndex];
  if (obesity) {
    for (var p in plotData) {
      plotData[p] = Math.max(plotData[p],input[ageIndex + 7][p])
    }
  }
  if (ht) {
    for (var p in plotData) {
      plotData[p] = Math.max(plotData[p],input[ageIndex + 14][p])
    }
  }
  if (smoking) {
    for (var p in plotData) {
      plotData[p] = Math.max(plotData[p],input[ageIndex + 21][p])
    }
  }
  return plotData
}
