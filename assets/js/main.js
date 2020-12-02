var myarr;

myarr = [
  {
    id: 2,
    startValue: 20,
    endValue: 70,
    color: "#CF1920",
    startAt: " 00:00",
    endAt: " 30:00"
  } 
];

$(function() {
	
  var renderLabel;
  renderLabel = function(ui, customContent) {
    var content, endAt, range, startAt;
    if (customContent == null) {
      customContent = false;
    }
    range = ui.range;
    startAt = moment(range.startAt, "  h:mm").add(range.startValue, "minutes");
    endAt = moment(range.startAt, " h:mm").add(range.endValue, "minutes");
    content = "" + (startAt.format(" h:mm")) + " -- " + (endAt.format(" h:mm"));
    if (customContent) {
      content = $("<div style='left: -40px;position: absolute;'>" + (startAt.format(" h:mm")) + "</div><div style='right: -40px;position: absolute;'>" + (endAt.format("  h:mm")) + "</div>");
    }
    return content;
  };
  $('#slider-range').rangeSlider({
    min: 0,
    max: 1440,
    ranges: myarr
  });
  $('#slider-range-timer').rangeSlider({
    min: 0,
    max: 1440,
    ranges: myarr,
    rangeSlide: function(event, ui) {
      return $("#display-timer").empty().append(renderLabel(ui));
    }
  });
  
  
 
  
  
  return $('#slider-range-custom-label').rangeSlider({
    min: 0,
    max: 90,
    ranges: myarr,
    rangeLabel: function(event, ui) {
      return ui.label.empty().append(renderLabel(ui, true));
    },
    rangeSlide: function(event, ui) {
      return $("#display-label-timer").empty().append(renderLabel(ui));
    }
	
	
  });
  
   return $('#slider-range-custom-label1').rangeSlider({
    min: 0,
    max: 90,
    ranges: myarr,
    rangeLabel: function(event, ui) {
      return ui.label.empty().append(renderLabel(ui, true));
    },
    rangeSlide: function(event, ui) {
      return $("#display-label-timer").empty().append(renderLabel(ui));
    }
	
	
  });
  
});
 

