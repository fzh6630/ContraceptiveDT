var scrollTime = 250;
var tourWidth = 240;

var tour = {
  id: "beginTour",
  steps: [
    {
      title: "Main menu",
      content: "Select <b>Info</b>, <b>Help</b>, and <b>Acknowledgements</b> for basic information about this app.  Select <b>Survey</b> to submit any comments to the app authors.  <b>Admin</b> is for app administrators. <b>Tour</b> will restart this tour. (To quick the tour at any time, click on x in upper right of this bubble.)",
      target: "hamburger_menu",
      placement: "right",
      xOffset: 50,
      width: tourWidth,
      delay: 30,
    },
    {
      title: "Plots",
      content: "If you want to see a particular outcome (e.g., <b>CVA</b>) at the top of the screen, click here. Standard abbreviations are used:<ul><li><b>MI</b> Myocardial Infarction.</li><li><b>CVA</b> Cerebrovascular accident.</li><li><b>VTE</b> Venous thromboembolism.</li><li><b>PID</b> Pelvic inflammatory disease.</li><li><b>Ect</b> Ectopic pregnancy.</li></ul>",
      target: "plotCVA_button",
      placement: "bottom",
      showPrevButton: true,
      nextOnTargetClick: true,
      xOffset: Math.round(-tourWidth/2)+20,
      arrowOffset: "center",
      width: tourWidth,
      onPrev: function() {
        document.getElementById("menuDropdown").className = "dropdown open";
      },
    },
    {
      title: "Bar graphs",
      content: "The bars show outcome rates for various contraceptive choices.  The <b>vertical axes</b> are rates per 100,000 users per year. The contraceptive choices in the <b>horizontal axis</b> and the patient characteristics are selected using the menu buttons at the bottom of the screen. See <b>Help</b> in the <b>menu button</b> (at the upper left corner of screen) for more details.",
      target: "plotMI_button",
      placement: "bottom",
      arrowOffset: "center",
      width: tourWidth,
      delay: scrollTime,
      showPrevButton: true,
      yOffset: 150,
    },
    {
      title: "Bottom menu",
      content: "These buttons will open submenus for <b>Choices</b> of contraceptives, <b>Patient</b> characteristics, and a <b>Range</b> of patient characteristics that will appear in the plots. <b>Reset</b> will set all selections to default values.  The 'x' on the far right will close any open submenus.",
      target: "Choices_button",
      placement: "top",
      showPrevButton: true,
      width: tourWidth,
      delay: scrollTime,
      onNext: function() {
        $("#nav-content-2").addClass("in");
      },
    },
    {
      title: "Range",
      content: "These selections will display a range of patient characteristics. For instance <b>Hypertension</b> will show results for patients with and without hypertension.",
      target: "Range_button",
      placement: "top",
      showPrevButton: true,
      xOffset: Math.round(-tourWidth/2),
      arrowOffset: "center",
      width: tourWidth,
      delay: scrollTime,
      onNext: function() {
        document.getElementById("menuDropdown").className = "dropdown open";
        $("#nav-content-2").removeClass("in");
      },
    },
    {
      title: "Survey",
      content: "We would appreciate it if you filled out our survey after you have used this app.",
      target: "surveyMenu",
      width: Math.round(tourWidth*0.75),
      xOffset: -100,
      placement: "right",
      delay: 30,
    },
  ],
};

function hopscotchTour() {
  document.getElementById("menuDropdown").className = "dropdown open";
  hopscotch.startTour(tour);
}
