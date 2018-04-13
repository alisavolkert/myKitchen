/*
Copyright [2017] [Universität Tübingen]

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/
// global variables
var countClicks = 0;
var num_of_clicks_on_obj = 0;
var startTime = new Date();
var endTime = startTime;

var regal_ids = ["time/ID","s1-1l","s1-1r","s1-2l","s1-2r","s1-3l","s1-3r","s2-1l","s2-1r","s2-2l","s2-2r","s2-3l","s2-3r","s3-1l","s3-1r","s3-2l","s3-2r","s4-1l","s4-1r","s4-2l","s4-2r","s5-1l","s5-1r","s6-1l","s6-1r","s6-2l","s6-2r","s6-3l","s6-3r","s7-1l","s7-1r","s8-1l","s8-1r","s9-1l","s9-1r","s9-2l","s9-2r","s10-1l","s10-1r","s11-1l","s11-1r","s11-2l","s11-2r","s12-1l","s12-1r","s12-2l","s12-2r","obfl1r","obfl1r","obfl3l","obfl3r","obj"];
var results = new Array();
var index = 0;

$(document).ready(function() {
	/* change number of mouse clicks and date */
	$(".all").click(function(event){
		countClicks++;
		if ( $(event.target).hasClass('objekte') ) { num_of_clicks_on_obj++; }
		endTime = new Date();
		//$("#test").html(timeToString(startTime) + " " + timeToString(endTime) + " " + countClicks + " " + num_of_clicks_on_obj);
	});

	/* make shelves sortable */
  $('.regal').sortable({
    connectWith: '.regal',
    placeholder: 'objekte',
    revert: 50,
    start: function(event, ui) {
			num_of_clicks_on_obj++;
			countClicks++;
			endTime = new Date();

			/* calculate space in shelf */
			var obj_id = ui.item.attr('id');
			var obj_width = parseFloat(ui.item.css('min-width')).toFixed(2);
			var obj_height = parseFloat(ui.item.css('min-height')).toFixed(2);
			var obj_length = parseFloat(ui.item.css('perspective')).toFixed(2);
			var obj_volume = obj_length * obj_height * obj_width;

			var l = regal_ids.length - 1;
			for (var i = 1; i < l; i++ ){
				var id = '#' + regal_ids[i];
				var pw = +getPlaceholderVolume(id) + +obj_volume;

				var w = parseInt($(id).css('min-width'));
				var h = parseInt($(id).css('min-height'));
				var d = parseInt($(id).css('perspective'));
				var regal_volume = w * h * d;

				if ( pw > regal_volume || h < obj_height ) {
					$(id).css('opacity', 0.5);
				}
			}
      ui.placeholder.height(30);
			ui.placeholder.width(30);
    },
    stop: function(event, ui) {
			/* put and scale object */

			var old_parent_id = $(event.target).attr("id");
			var new_parent_id = ui.item.parent().attr("id");

			var obj_id = ui.item.attr('id');
			var obj_width = parseFloat(ui.item.css('min-width'));
			var obj_height = parseFloat(ui.item.css('min-height'));
			var obj_length = parseFloat(ui.item.css('perspective'));
			var obj_volume = obj_length * obj_height * obj_width;

			var parent_width = parseInt($("#" + new_parent_id).css('min-width'));
			var parent_height = parseInt($("#" + new_parent_id).css('min-height'));
			var parent_depth = parseInt($("#" + new_parent_id).css('perspective'));
			var regal_volume = parent_width * parent_height * parent_depth;

			var placeholder_volume = getPlaceholderVolume("#" + new_parent_id);

			if (old_parent_id != new_parent_id) {
				if (new_parent_id == 'obj') {
					ui.item.css('width', 100);
					ui.item.css('height', 100);
				} else {
					if (obj_height > parent_height) {
						$('#' + old_parent_id).append(ui.item);
						alert("Passt nicht rein!");
					} else {
						if ( regal_volume >= placeholder_volume ) {
							var ratio = scaleFactor(obj_width, obj_height, 60, 20);

							ui.item.css('width', 100);
							ui.item.css('height', 100);

							ui.item.css('width', ratio);
							ui.item.css('height', ratio);
							ui.item.css('horizontal-align','bottom');
						} else {
							$('#' + old_parent_id).append(ui.item);
							alert("Kein Platz mehr!");
						}
					}
				}
			}
			$(".regal").css('opacity', 1);

			index = results.length;

			// save current state in results - array
			var n = results.length;
			var l = regal_ids.length;
			results[n] = new Array();
			results[n][0] = timeToString(new Date());

			for (var i = 1; i < l; i++){

				var children = [];
				$("#" + regal_ids[i]).children().each( function (){
					children.push($(this).attr('id'));
				});
				results[n][i] = children.toString();
			}
    },
  });

	/* Undo */
	$("#back").click(function() {
		//window.history.back();
		if ( index > 0 ) {
			index--;

			$(".regal").html("");
			var l = regal_ids.length;
			while (results[index][1] == "RESTART") {
				index--;
			}

			for ( var i = 1; i < l; i++ ) {
				var children = results[index][i];
				children = children.split(",");
				var l2 = children.length;

				for (var j = 0; j < l2; j++) {
					var c = parseInt(children[j]);

					if (! isNaN(c)){
						var offset = setOffset(daten[c-1][3], daten[c-1][4], daten[c-1][5]);
						if ( regal_ids[i] == "obj") {
							$("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="images/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:100px;height:100px;'+ offset +'"/>');
						} else {
							var ratio = scaleFactor(daten[c-1][4], daten[c-1][3], 60, 20);
							$("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="images/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:'+ ratio +'px;height:'+ ratio +'px;'+ offset +'"/>');
						}
					}
				}
			}
		}
	});

	/* Redo */
	$("#next").click(function() {
		if ( index < results.length -1 ) {
			index++;
			$(".regal").html("");
			var l = regal_ids.length;
			while (results[index][1] == "RESTART") {
				index++;
			}

			for ( var i = 1; i < l; i++ ) {
				var children = results[index][i];
				children = children.split(",");
				var l2 = children.length;

				for (var j = 0; j < l2; j++) {
					var c = parseInt(children[j]);
					if (! isNaN(c)){
						var offset = setOffset(daten[c-1][3], daten[c-1][4], daten[c-1][5]);
						if ( regal_ids[i] == "obj") {
							$("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="images/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:100px;height:100px;'+ offset +'"/>');
						} else {
							var ratio = scaleFactor(daten[c-1][4], daten[c-1][3], 60, 20);
							$("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="images/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:'+ ratio +'px;height:'+ ratio +'px;'+ offset +'"/>');
						}
					}
				}
			}
		}
	});

	/* open doors */
	$("#open").click(function() {
		$(".door").animate({opacity:'0'})
		$(".door").css('z-index', '0')

		$(".schrank").css('z-index', '1')
		$(".schrank").css('display', 'block')
	});

	/* close doors */
	$("#close").click(function() {
		$(".door").animate({opacity:'1'})
		$(".door").css('z-index', '1')

		$(".door").removeClass("opendoorleft")
		$(".door").removeClass("opendoorright")
		$(".door").removeClass("opendrawer")
		$(".door").removeClass("opendoorup")
		$(".door").removeClass("opendoordown")

		$(".schrank").css('z-index', '0')
		$(".schrank").css('display', 'none')
	});

	/* reload the kitchen */
	$('#refresh').click(function() {
		var l = regal_ids.length;
		var tmp = new Array(l);
		tmp[0] = timeToString(new Date());
		tmp[1] = 'RESTART';
		results.push(tmp);

		// location.reload();
		$(".regal").html("");
		for (var i = 0; i < daten.length; i++){
			var offset = setOffset(daten[i][3], daten[i][4], daten[i][5]);
			$("#obj").append('<img class="objekte" id="' + daten[i][0] + '" src="images/' + daten[i][2] + '" alt="' + daten[i][1] + '" style="' + offset + '"/>')
		}

		// close doors
		$(".door").animate({opacity:'1'})
		$(".door").css('z-index', '1')

		$(".door").removeClass("opendoorleft")
		$(".door").removeClass("opendoorright")
		$(".door").removeClass("opendrawer")
		$(".door").removeClass("opendoorup")
		$(".door").removeClass("opendoordown")

		$(".schrank").css('z-index', '0')
		$(".schrank").css('display', 'none')
		for (var i = 1; i < 13; i++){
			$("#d"+i).html("S"+i);
		}

	});

	/* finish the simulation and send user data via ajax */
	$('#finish').click(function(){
		row.unshift('save');
		row.push(timeToString(startTime), timeToString(new Date()), countClicks, num_of_clicks_on_obj);

		$.ajax({
				type: 'POST',
				url: this.url,
				data: {
					arr1 : row,
					arr2 : results,
					arr3 : regal_ids
				}
		});

		//location.reload();

		$(".all").addClass("hidden");
		$("h3").removeClass("hidden");
	});

	/* open or close a door severally */
	$(".door").click(function() {
		var door_id = $(this).attr('id');
		var classname = "";

		// add relevant class
		switch (door_id) {
			case "d1":
			case "d11":
				classname = "opendoorleft";
				break;
			case "d2":
			case "d3":
			case "d5":
			case "d6":
			case "d9":
				classname = "opendoorright";
				break;
			case "d7":
			case "d8":
			case "d10":
				classname = "opendrawer";
				break;
			case "d4":
				classname = "opendoorup";
				break;
			case "d12":
				classname = "opendoordown";
				break;
			default:
				classname = "";
		}

		door_id = "#" + door_id;
		var schrank_id = door_id.replace("d", "s");

		if ($(door_id).hasClass(classname)) {
			$(door_id).removeClass(classname);
			$(schrank_id).css('display', 'none');
			$(door_id).html((schrank_id.substr(1)).toUpperCase());
		} else {
			$(door_id).addClass(classname);
			$(schrank_id).css('display', 'block');
			$(door_id).html("");
		}
	});
});

/* set object offset */
var setOffset = function(height, width, depth){
	return "min-height:" + height + "px;min-width:" + width + "px;perspective:" + depth + "px;";
}

/* calculate scale factor */
var scaleFactor = function(obj_width, obj_height, parent_width, parent_height){
	var scale_width = Math.round((obj_width / parent_width) * 100) / 100;
	var scale_height = Math.round((obj_height / parent_height) * 100) / 100;
	scale_width = Math.min(scale_width, 0.5);
	scale_height = Math.min(scale_height, 0.5);

	var scale_factor = Math.round(((+scale_height + +scale_width) / 2) * 100) / 100;
	scale_factor = Math.min(scale_factor, 0.7);
	scale_factor = Math.max(scale_factor, 0.15);

	return scale_factor * 100;
}

/* create distance table
* it works if css-display is not none!
* (shelves should be "open")
*/
var distanceTable = function(){
	var schrank = $('.schrank').map(function() {
		return $(this).attr('id');
	});
	var regal = $('.regal').map(function() {
		return $(this).attr('id');
	});

	var l = schrank.length + regal.length + 1;
	var distance = new Array(l);
	schrank.push.apply(schrank, regal);
	Array.prototype.unshift.call(schrank, 'pixels');

	for (var i = 0; i < l; i++){
		distance[i] = new Array(l);
		distance[0][i] = schrank[i];
		distance[i][0] = distance[0][i];
	}

	/* calculate distance in pixels and fill table-array */
	for (var i = 1; i < l; i++){
		for (var j = i; j < l; j++){
			if (distance[0][i] == distance[j][0]){
				distance[j][i] = 0;
			} else {
				var o1 = $("#" + distance[0][i]).offset();
				var o2 = $("#" + distance[j][0]).offset();

				var x1 = o1.left + $("#" + distance[0][i]).width();
				var y1 = o1.top + $("#" + distance[0][i]).height();
				var x2 = o2.left + $("#" + distance[j][0]).width();
				var y2 = o2.top + $("#" + distance[j][0]).height();

				distance[i][j] = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2),2)).toFixed(2);
				distance[j][i] = distance[i][j];
			}
		}
	}

	return distance;
}

/* calculate sum of object volumes in shelf */
var getPlaceholderVolume = function(id) {
	var placeholder_volume = 0;
	$(id).children().each( function (){
		var obj_width = parseFloat($(this).css('min-width'));
		var obj_height = parseFloat($(this).css('min-height'));
		var obj_length = parseFloat($(this).css('perspective'));
		var obj_volume = obj_length * obj_height * obj_width;
		placeholder_volume += obj_length * obj_height * obj_width;
	});

	return placeholder_volume.toFixed(2);
}

// add zero if date less then 10
var convertDate = function(d){
	return (d < 10)? ("0" + d) : d;
}

// time to string
var timeToString = function(d){
	return convertDate(d.getHours()) + ":" + convertDate(d.getMinutes()) + ":" + convertDate(d.getSeconds());
}

/* hide kitchen object(s) */
var hideImage = function(id) {
	$(id).addClass('transparent');
}

/* show kitchen object(s) */
var showImage = function(id) {
	$(id).removeClass('transparent');
}
