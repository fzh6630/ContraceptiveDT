<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contraceptive Decision Support Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/hopscotch/0.3.1/css/hopscotch.css">

  <!-- <link rel="stylesheet" type="text/css" href="library/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/hopscotch/0.3.1/js/hopscotch.js"></script>

  <!-- <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> -->
  <script src="library/plotly-latest.min.js"></script>

  <script src="https://d3js.org/d3-collection.v1.min.js"></script>
  <script src="https://d3js.org/d3-dispatch.v1.min.js"></script>
  <script src="https://d3js.org/d3-dsv.v1.min.js"></script>
  <script src="https://d3js.org/d3-request.v1.min.js"></script>

  <link   rel="stylesheet" type="text/css" href="css/checkbox1.css"/>
  <script type="text/javascript" src="js/barplot6.js"></script>
  <script type="text/javascript" src="js/tourMain.js"></script>
</head>


<body data-spy="scroll" data-target="#myNavbar" data-offset="50">

<nav class="navbar navbar-expand navbar-inverse navbar-fixed-top" id="myNavbar">
  <!-- <a class="navbar-brand" href="#"></a> -->
  <ul class="nav nav-pills">
    <li class="dropdown" id="menuDropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"><span class="glyphicon glyphicon-menu-hamburger" id="hamburger_menu"></span></a>
      <ul class="dropdown-menu">
        <li><a style="font-size:125%" href="index.php"    >Home  </a></li>
        <li><a style="font-size:125%" href="bs_survey.php" id="surveyMenu">Survey</a></li>
        <li><a style="font-size:125%" href="db_setup.php" >Admin </a></li>
        <li class="divider"></li>
        <li><a style="font-size:125%" href="#helpModal" data-toggle="modal" id="helpMenu">Help</a></li>
        <li><a style="font-size:125%" href="#infoModal" data-toggle="modal">Info</a></li>
        <li><a style="font-size:125%" href="#acknModal" data-toggle="modal">Acknowledgements</a></li>
        <li><a style="font-size:125%" href="#"          onclick="hopscotchTour()">Tour</a></li>
      </ul>
    </li>
    <li><a href="#plotMI"      id="plotMI_button"  >Myocardial Infarction     </a></li>
    <li><a href="#plotCVA"     id="plotCVA_button" >Cerebrovascular Accident    </a></li>
    <li><a href="#plotVTE"      >Venous Thromboembolism    </a></li>
    <li><a href="#plotPID"      >Pelvic inflammatory Disease    </a></li>
    <li><a href="#plotEctopic"  >Ectopic Pregnancy    </a></li>
  </ul>
</nav>
<div id="plotMI"      class="container-fluid"><!-- Plotly chart will be drawn inside this DIV --></div>
<div id="plotCVA"     class="container-fluid"><!-- Plotly chart will be drawn inside this DIV --></div>
<div id="plotVTE"     class="container-fluid"><!-- Plotly chart will be drawn inside this DIV --></div>
<div id="plotPID"     class="container-fluid"><!-- Plotly chart will be drawn inside this DIV --></div>
<div id="plotEctopic" class="container-fluid"><!-- Plotly chart will be drawn inside this DIV --></div>
<div id="plotBlank"   class="container-fluid" style="height: 400px"> </div>

<!-- Modal -->
<div id="infoModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Contraceptive Decision Support Tool</h3>
      </div>
      <div class="modal-body">
        <h4>Scientific authors and contributors:</h4>
        <h4>Caroline Moreau, MD, PhD</h4>
        <h4>Anne Burke, MD, MPH</h4>
        <h4>Suzanne Bell, PhD</h4>
        <h4>Susanna Gibbs, PhD</h4>
        <br />
        <h5>App designers:</h5>
        <h5>Tak Igusa and Zhaohao Fu</h5>
        <br />

        <h4>DISCLAIMER</h4>
        <p>
          The Authors provides the App and the services, information, content and/or data (collectively, “Information”) contained therein for informational purposes only. The Author does not provide any medical advice on the App, and the Information should not be so construed or used. Using the App and/or providing personal or medical information to the Authors does not create a physician-patient relationship between you and the Authors. Nothing contained in the App is intended to create a physician-patient relationship, to replace the services of a licensed, trained physician or health professional or to be a substitute for medical advice of a physician or trained health professional licensed in your state. You should not rely on anything contained in the App, and you should consult a physician licensed in your state in all matters relating to your health. You hereby agree that you shall not make any health or medical related decision based in whole or in part on anything contained in the App.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="acknModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Contraceptive Decision Support Tool</h3>
      </div>
      <div class="modal-body">
        <h4>Acknowledgements</h4>
        <p>
          The development of this mobile web application was partially supported by the Society for Family Planning and by the Hopkins Population Center, Grant Number R24 HD042854 from the Eunice Kennedy Shriver Na1onal Institute of Child Health and Human Development (NICHD). The content is solely the responsibility of the authors and does not necessarily represent the official views of the Society for Family Planning, NICHD, the Hopkins Population Center, or the Johns Hopkins University.
        </p>
        <h5>Suggested citation format</h5>
        <p>
          Moreau, C, Burke, A, Bell, S, Gibbs, S, Fu, Z and Igusa, T (2017). Contraceptive Decision Support Tool (Beta Version 2.1). Johns Hopkins University, Baltimore, MD. [Mobile application software.] Available from: https://engineering.jhu.edu/tak/contraceptive_DS_tool/index.php
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="helpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Contraceptive Decision Support Tool: Help</h3>
      </div>
      <div class="modal-body">
        <div class="panel-group">
          <div class="panel-primary">
            <div class="panel-heading">Upper menu</div>
            <div class="panel-body">
              <h5>Navigation button (upper left)</h5>
              <ul>
                <li>This leads to the <b>Survey</b>, <b>Admin</b>, <b>Help</b> and <b>Info</b> screens.</li>
                <li>The <b>Survey</b> screen allow users to give feedback to the scientific authors (Caroline Moreau, PhD and Anne Burke, MD) and to the web designers.</li>
                <li>The <b>Admin</b> screen is available only to the authors and designers.</li>
              </ul>
              <h5>Menu of outcomes</h5>
              <ul>
                <li>These are the primary outcomes of interest.  You can click on any outcome and the corresponding plot will move to the top of the screen.</li>
                <li><b>MI</b> Myocardial Infarction.</li>
                <li><b>CVA</b> Cerebrovascular accident.</li>
                <li><b>VTE</b> Venous thromboembolism.</li>
                <li><b>PID</b> Pelvic inflammatory disease.</li>
                <li><b>Ect</b> Ectopic pregnancy.</li>
              </ul>
            </div>
          </div>
          <div class="panel-primary">
            <div class="panel-heading">Graphs</div>
            <div class="panel-body">
              <h5>Bar graphs</h5>
              <ul>
                <li>These show outcome rates for various contraceptive choices.</li>
                <li>The <b>vertical axis</b> are rates per 100,000 users per year.</li>
                <li>The contraceptive choices in the <b>horizontal axis</b> can be selected by the menu at the bottom of the screen.</li>
              </ul>
            </div>
          </div>
          <div class="panel-primary">
            <div class="panel-heading">Lower menu</div>
            <div class="panel-body">
              <h5>Choices</h5>
              <ul>
                <li>Various contraceptive choices can be selected.</li>
                <li>The reset button will select all choices.</li>
                <li>The close button ("x") on the right will close this and all other lower menus.</li>
              </ul>
              <h5>Patient</h5>
              <ul>
                <li>The characteristics of the patient are input here.</li>
                <li>The reset button will change all characteristics to default values.</li>
              </ul>
              <h5>Range</h5>
              <ul>
                <li>Charts are generated with a range of values for patient characteristics.</li>
                <li><b>No range</b> This is the default, using the selection under <b>patient</b> characteristics.</li>
                <li><b>Age</b> Range from 15 to 49 years old.</li>
                <li><b>Smoking</b> Mon smokers and smokers.</li>
                <li><b>Hypertension</b> With and without hypertension.</li>
                <li><b>Obese</b> Obese (BMI > 30) or not obese.</li>
              </ul>
              <h5>Reset</h5>
              <ul>
                <li>Charts are reset to all contraceptive choices and default patient characteristics.</li>
                <li>The <b>Range</b> option would not change.</li>
              </ul>
            </div>
          </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-bottom navbar-expand-sm">
  <div class="container-fluid" id="accordion">
    <button class="navbar-toggler navbar-btn" type="button" data-toggle="collapse" data-parent="#accordion" data-target="#nav-content" aria-controls="nav-content"   aria-expanded="false" aria-label="Toggle-navigation" id="Choices_button"><b>Choices</b></button>

    <button class="navbar-toggler navbar-btn" type="button" data-toggle="collapse" data-parent="#accordion" data-target="#nav-content-1" aria-controls="nav-content-1" aria-expanded="false" aria-label="Toggle-navigation" id="Patient_button"><b>Patient</b></button>

    <button class="navbar-toggler navbar-btn" type="button" data-toggle="collapse" data-parent="#accordion" data-target="#nav-content-2" aria-controls="nav-content-2" aria-expanded="false" aria-label="Toggle-navigation"  id="Range_button"><b>Range</b></button>

    <button class="navbar-btn" onclick="fReset(this)">Reset</button>

    <!-- <button class="navbar-btn" onclick="fClose()"">Close</button> -->
    <button type="button" class="close" onclick="fClose()">
      <span style="color: #fff!important; opacity: 1!important;">&times;</span>
    </button>

    <div class="panel">
      <div class="collapse" id="nav-content-1">
        <table class="table-condensed">
          <tbody>
            <tr>
              <td>
                <label for="selectAge">Age:</label>
                <select class="form-control" id="selectAge" oninput="updateSelect()">
                  <option>15-19</option>
                  <option>20-24</option>
                  <option selected="selected">25-29</option>
                  <option>30-34</option>
                  <option>35-39</option>
                  <option>40-44</option>
                  <option>45-49</option>
                </select>
              </td>
              <td>
                <label for="inputHeight">Height(cm):</label>
                <input type="number" class="form-control" id="inputHeight"  min="80" max="300" value = "165" oninput="updateSelect()">
              </td>
              <td>
                <label for="inputWeight">Weight(kg):</label>
                <input type="number" class="form-control" id="inputWeight" min="20" max="500" value = "60" oninput="updateSelect()">
              </td>
            </tr>
            <tr>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxHt" id="checkboxHt" autocomplete="off" onchange="updateSelect()"/>
                  <div class="[ btn-group ]">
                    <label for="checkboxHt" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxHt" class="[ btn btn-default active ]">
                      Hypertension
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxSmoking" id="checkboxSmoking" autocomplete="off" onchange="updateSelect()"/>
                  <div class="[ btn-group ]">
                    <label for="checkboxSmoking" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxSmoking" class="[ btn btn-default active ]">
                      Smoking
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div>
                  <input type="submit">
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="panel">
      <div class="collapse" id="nav-content-2">
        <form>
          <label class="radio-inline">
            <input type="radio" id="noStudy"         name="choose"  onchange="updateSelect()" checked="checked">No range
          </label>
          <label class="radio-inline">
            <input type="radio" id="Ages"            name="choose"  onchange="updateSelect()" >Age
          </label>
          <label class="radio-inline">
            <input type="radio" id="SmokingYN"       name="choose"  onchange="updateSelect()" >Smoking
          </label>
          <br />
          <label class="radio-inline">
            <input type="radio" id="HyptertensionYN" name="choose"  onchange="updateSelect()" >Hyptertension
          </label>
          <label class="radio-inline">
            <input type="radio" id="ObeseYN"         name="choose"  onchange="updateSelect()" >Obesity
          </label>
          <br />
        </form>
      </div>
    </div>

    <div class="panel">
      <div class="collapse" id="nav-content">
        <table>
          <tbody>
            <tr>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxSterilization" id="checkboxSterilization"  onchange="updateSelect()"autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxSterilization" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>                                                 
                    </label>
                    <label for="checkboxSterilization" class="[ btn btn-default active ]">
                      Sterilization
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxPill1" id="checkboxPill1"  onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxPill1" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxPill1" class="[ btn btn-default active ]">
                      Combined oral contraceptives
                    </label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxPill2" id="checkboxPill2" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxPill2" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxPill2" class="[ btn btn-default active ]">
                      Progestin-only pill
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxIUD1" id="checkboxIUD1" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxIUD1" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxIUD1" class="[ btn btn-default active ]">
                      Copper IUD
                    </label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxIUD2" id="checkboxIUD2" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxIUD2" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxIUD2" class="[ btn btn-default active ]">
                      Levonorgestrel IUD
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkbox3mi" id="checkbox3mi" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkbox3mi" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkbox3mi" class="[ btn btn-default active ]">
                      Injectable
                    </label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxImplant" id="checkboxImplant" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxImplant" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxImplant" class="[ btn btn-default active ]">
                      Implant
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxCondom" id="checkboxCondom" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxCondom" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxCondom" class="[ btn btn-default active ]">
                      Condom
                    </label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxWd" id="checkboxWd" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxWd" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxWd" class="[ btn btn-default active ]">
                      Withdrawal
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <div class="[ form-group ]">
                  <input type="checkbox" name="checkboxNo" id="checkboxNo" onchange="updateSelect()" autocomplete="off" checked = "True"/>
                  <div class="btn-group btn-group-xs">
                    <label for="checkboxNo" class="[ btn btn-info ]">
                      <span class="[ glyphicon glyphicon-ok ]"></span>
                      <span> </span>
                    </label>
                    <label for="checkboxNo" class="[ btn btn-default active ]">
                      No method
                    </label>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</nav>


<script>
  var age
  var height
  var weight
  var ht
  var smoking
  var obesity

  var sterilization
  var pill1
  var pill2
  var iud1
  var iud2
  var injection
  var implant
  var condom
  var withdrawl
  var nomethod

  var Ages
  var noStudy
  var SmokingYN
  var HyptertensionYN
  var ObeseYN

  // Start the tour!
  hopscotchTour();

  updateSelect();

  function updateSelect() {
    age     = document.getElementById("selectAge"      ).value
    height  = document.getElementById("inputHeight"    ).value
    weight  = document.getElementById("inputWeight"    ).value
    ht      = document.getElementById("checkboxHt"     ).checked
    smoking = document.getElementById("checkboxSmoking").checked
    obesity = fObesity(height, weight)

    sterilization = document.getElementById("checkboxSterilization").checked
    pill1     = document.getElementById("checkboxPill1").checked
    pill2     = document.getElementById("checkboxPill2").checked
    iud1      = document.getElementById("checkboxIUD1" ).checked
    iud2      = document.getElementById("checkboxIUD2" ).checked
    injection = document.getElementById("checkbox3mi"  ).checked
    implant   = document.getElementById("checkboxImplant").checked
    condom    = document.getElementById("checkboxCondom" ).checked
    withdrawl = document.getElementById("checkboxWd"   ).checked
    nomethod  = document.getElementById("checkboxNo"   ).checked

    noStudy   = document.getElementById("noStudy").checked
    Ages      = document.getElementById("Ages"   ).checked
    ObeseYN   = document.getElementById("ObeseYN").checked
    SmokingYN = document.getElementById("SmokingYN").checked
    HyptertensionYN = document.getElementById("HyptertensionYN").checked

    if (noStudy) {
      updatePlots();
    } else {
      updateMultiPlots();
    }
  };

  function fObesity(height, weight) {
    return (weight * weight / height >= 30);
  }

  function fReset(button) {
    document.getElementById("selectAge"      ).value = "25-29"
    document.getElementById("inputHeight"    ).value = "165"
    document.getElementById("inputWeight"    ).value = "60"
    document.getElementById("checkboxHt"     ).checked = false
    document.getElementById("checkboxSmoking").checked = false

    document.getElementById("checkboxSterilization").checked = true
    document.getElementById("checkboxPill1"  ).checked = true
    document.getElementById("checkboxPill2"  ).checked = true
    document.getElementById("checkboxIUD1"   ).checked = true
    document.getElementById("checkboxIUD2"   ).checked = true
    document.getElementById("checkbox3mi"    ).checked = true
    document.getElementById("checkboxImplant").checked = true
    document.getElementById("checkboxCondom" ).checked = true
    document.getElementById("checkboxWd"     ).checked = true
    document.getElementById("checkboxNo"     ).checked = true

    updateSelect();
  }

  function fEnter(button) {
    updateSelect();
  }

  function fClose() {
      $('.collapse').collapse("hide");
  };

  // // Accordion default to close
  // $( document ).ready(function() {
  //   $('.collapse').collapse("hide");
  // });

  // Add smooth scrolling on all links inside the navbar
  $(document).ready(function(){
    // Add scrollspy to <body>
    // $('body').scrollspy({target: ".navbar", offset: 50});   

    // Add smooth scrolling on all links inside the navbar
    $("#myNavbar a").on('click', function(event) {
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 300, function(){
     
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      }  // End if
    });
  });

</script>
</body>
</html>
