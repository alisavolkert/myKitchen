// global values
var countClicks = 0;
var num_of_clicks_on_obj = 0;
var startTime = new Date();
var endTime = startTime;

// var regal_ids = ["time/ID","sv1-1","sv1-2","sv2-1","sv2-2","sv3-1","sv3-2","sv4-1","sv4-2","sv5-1",
//     "sv5-2","sv6-1","sv6-2","sv6-3","sv6-4","sv6-5","sv7","sv8","sv9-1","sv9-2","sv9-3",
//     "sv10-1","sv10-2","sv10-3","obfl1","obfl2","obfl3","obfl4","obfl5","obj","sv11"];
var regal_ids = ["time/ID","sv1-1","sv1-2","sv2-1","sv2-2","sv3-1","sv3-2","sv4-1","sv4-2","sv5-1",
    "sv5-2","sv6-1","sv6-2","sv6-3","sv6-4","sv6-5","sv7","sv8","sv9-1","sv9-2","sv9-3",
    "sv10-1","sv10-2","sv10-3","obfl1","obfl2","obfl3","obfl4","obfl5","obj"];
// speihert aktuellen Zustand (Elemente werden bei back-Button NICHT entfernt)
var results = new Array();
// speichert aktuellen Zustand (Elemente werden bei back-Button entfernt)
var results_history_change = [];
var index = 0; /* Undo-Redo */
var last_open_shelf = "start";
// var all_door_ids = ["d1-1","d1-2","d2-1","d2-2","d3-1","d3-2","d4-1","d4-2","d5-1","d5-1","d6-1","d6-2","d6-3","d6-4","d6-5",
//     "d7","d8","d9-1","d9-2","d9-3","d10-1","d10-2","d10-3"];
var all_door_ids = ["d1", "d2", "d3","d4","d5","d6-1","d6-2","d6-3","d6-4","d6-5",
    "d7","d8","d9-1","d9-2","d9-3","d10-1","d10-2","d10-3"];


$(document).ready(function() {
    /* change number of mouse clicks and date */
    $(".all").click(function(event){
        countClicks++;
        if ( $(event.target).hasClass('objekte') ) { num_of_clicks_on_obj++; }
        endTime = new Date();
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

            /* calculate space in shelf  */
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

            if (old_parent_id !== new_parent_id) {
                if (new_parent_id === 'obj') {
                    ui.item.css('width', 100);
                    ui.item.css('height', 100);
                } else {
                    if (obj_height > parent_height) {
                        $('#' + old_parent_id).append(ui.item);
                        alert("Passt nicht rein!");
                    } else {
                        if ( regal_volume >= placeholder_volume ) {

                            ui.item.css('width', 100);
                            ui.item.css('height', 100);

                            //Skalierung momentan auf 50% der Größe in der Liste
                            ui.item.css('width', 50);
                            ui.item.css('height', 50);
                            ui.item.css('horizontal-align','bottom');
                        } else {
                            $('#' + old_parent_id).append(ui.item);
                            alert("Kein Platz mehr!");
                        }
                    }
                }
            }


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


            if(results[n] !== null) {results_history_change[n] = results[n];}

            // wurde der back-button gedrückt, und dann ein Element hinzugefügt?
            //
            if (JSON.stringify(results) !== JSON.stringify(results_history_change)) {
                results = results_history_change.filter(arr=>arr!==null).map(arr => arr.slice());
                // results = results_history_change;
            }

            index = results.length-1;
            // console.log("index after adding " + index);
            // console.log("results" + JSON.stringify(results));
            $(".regal").css('opacity', 1);

            // Objekte unten im Extra-Fenster anzeigen
            if(new_parent_id !== 'obj') {
                showObjects("#" + new_parent_id);
            }
            // console.log("new_parent_id " + new_parent_id);
            // console.log("\n this.id " + this.id);


            if ($('#obj').find('img.objekte').length === 0) {
                document.getElementById('finish').disabled = false;
            } else {
                document.getElementById('finish').disabled = true;
            }
            document.getElementById('back').disabled = false;
        },
    });

    /* wenn 'back' solange gedrückt wurde, bis keine Gegenstände mehr in den Regalen/auf den Oberflächen sind*/
    function allImagesRightInObjClearAllShelves() {
        for (let j = 1; j < regal_ids.length-1; j++) {
            $("#" + regal_ids[j]).empty();
        }

        for (let i = 0; i < daten.length -1; i++) {
            let offset = setOffset(daten[i][3], daten[i][4], daten[i][5]);
            $("#obj").append('<img class="objekte" id="' + daten[i][0] + '" src="150px_Bilder/' + daten[i][2]
                + '" alt="' + daten[i][1] + '" style="width:100px;height:100px;'+ offset +'"/>');
        }

    }

    /* Undo */
    $("#back").click(function() {
        //window.history.back();

        document.getElementById('next').disabled = false;
        if (index <1) {
            document.getElementById('back').disabled = true;
        }

        if (results_history_change.length > 0 ) {
            results_history_change.splice(-1,1);
        }

        if ( index > 0 ) {
            // console.log("index right after click " + index);
            index--;
            if (index <= 0) {index = 0}
            // console.log("index right after decr " + index);
            $(".regal").html("");
            var l = regal_ids.length;
            while (results[index][1] === "RESTART") {
                index--;
            }


            // console.log("\n daten " + JSON.stringify(daten));
            for ( var i = 1; i < l; i++ ) {

                var children = results[index][i];
                // console.log("children before split " +JSON.stringify(children));
                children = children.split(",");
                var l2 = children.length;
                // console.log("\n children after split " +JSON.stringify(children));

                for (var j = 0; j < l2; j++) {

                    if (! isNaN(children[j]) && children[j] !== "") {
                        // console.log("children j " + children[j]);
                        let c = children[j];
                        var found = $.grep(daten, function (v) {
                            return v[0] === c;
                        });
                        // console.log("\n found " + JSON.stringify(found));

                        // var c = parseInt(children[j]);
                        // let c = found[0];
                        let offset = setOffset(found[0][3], found[0][4], found[0][5]);

                        if (i === (regal_ids.length-1)) {
                            $("#" + regal_ids[i]).append('<img class="objekte" id="' + found[0][0] + '" src="150px_Bilder/' + found[0][2] + '" alt="' + found[0][1] + '" style="width:100px;height:100px;' + offset + '"/>');
                        } else {
                            $("#" + regal_ids[i]).append('<img class="objekte" id="' + found[0][0] + '" src="150px_Bilder/' + found[0][2] + '" alt="' + found[0][1] + '" style="width:50px;height:50px;' + offset + '"/>');
                        }

                    }
                    // if (! isNaN(c)){
                        // var offset = setOffset(daten[c-1][3], daten[c-1][4], daten[c-1][5]);
                        // $("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="images/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:100px;height:100px;'+ offset +'"/>');
                        // $("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="150px_Bilder/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:100px;height:100px;'+ offset +'"/>');

                    // }
                }
            }
        } else if (index === 0 ) {
            allImagesRightInObjClearAllShelves();
        }
    });

    /* Redo */
    $("#next").click(function() {
        document.getElementById('back').disabled = false;
        if ( index < results.length ) {
            // console.log("next, index right after click " + index);

            if (index >= results.length-1) {
                document.getElementById('next').disabled = true;
            }

            $(".regal").html("");
            var l = regal_ids.length;
            while (results[index][1] === "RESTART") {
                index++;
            }

            if(results[index] !== null) {results_history_change[index] = results[index];}

            for ( var i = 1; i < l; i++ ) {
                var children = results[index][i];
                children = children.split(",");
                var l2 = children.length;

                for (var j = 0; j < l2; j++) {


                    // var c = parseInt(children[j]);
                    // if (! isNaN(c)){
                    //     var offset = setOffset(daten[c-1][3], daten[c-1][4], daten[c-1][5]);
                    //     // $("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="images/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:100px;height:100px;'+ offset +'"/>');
                    //     $("#" + regal_ids[i]).append('<img class="objekte" id="' + daten[c-1][0] + '" src="150px_Bilder/' + daten[c-1][2] + '" alt="' + daten[c-1][1] + '" style="width:100px;height:100px;'+ offset +'"/>');
                    // }



                    if (! isNaN(children[j]) && children[j] !== "") {
                        // console.log("children j " + children[j]);
                        let c = children[j];
                        var found = $.grep(daten, function (v) {
                            return v[0] === c;
                        });
                        // console.log("\n found " + JSON.stringify(found));

                        // var c = parseInt(children[j]);
                        // let c = found[0];
                        let offset = setOffset(found[0][3], found[0][4], found[0][5]);

                        if (i === (regal_ids.length-1)) {
                            $("#" + regal_ids[i]).append('<img class="objekte" id="' + found[0][0] + '" src="150px_Bilder/' + found[0][2] + '" alt="' + found[0][1] + '" style="width:100px;height:100px;' + offset + '"/>');
                        } else {
                            $("#" + regal_ids[i]).append('<img class="objekte" id="' + found[0][0] + '" src="150px_Bilder/' + found[0][2] + '" alt="' + found[0][1] + '" style="width:50px;height:50px;' + offset + '"/>');
                        }

                    }
                }
            }
            index++;
            // console.log("next, index right after incr " + index);
        }
        if (index >= results.length){index--;}
    });

    /* open doors */
    $("#open").click(function() {
        $(".door").animate({opacity:'0'});
        $(".door").css('z-index', '0');

        $(".schrank").css('z-index', '1');
        $(".schrank").css('display', 'block');


    });

    /* close doors */
    $("#close").click(function() {
        $(".door").animate({opacity:'1'});
        $(".door").css('z-index', '1');

        $(".door").removeClass("opendoorleft");
        $(".door").removeClass("opendoorright");
        $(".door").removeClass("opendrawer");
        $(".door").removeClass("opendoorup");
        $(".door").removeClass("opendoordown");

        $(".schrank").css('z-index', '0');
        $(".schrank").css('display', 'none');

        $('#test2').css('display', 'none');
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
            $("#obj").append('<img class="objekte" id="' + daten[i][0] + '" src="150px_Bilder/' + daten[i][2] + '" alt="' + daten[i][1] + '" style="' + offset + '"/>')
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

        // screenshot
        $('.all').html2canvas({
            onrendered: function (canvas) {
                var url = canvas.toDataURL("image/png").replace(/^data:image\/[^;]/, 'data:application/octet-stream');
                location.href = url;
            }
        });
    });


    function genScreenshot(){
        html2canvas(document.body, {
            onrendered: function(canvas) {
                $('#test_ss').attr('href', canvas.toDataURL("image/png"));
                $('#test_ss').attr('download', 'Test_file.png');
                $('#test_ss')[0].click();
            }
        })
    }

    $("#distance_table").click(function() {
        var distance_table = distanceTable();
        $.ajax({
            type: 'POST',
            url: this.url,
            data: {
                dist : distance_table
            }
        });
    });

    /* open or close a door severally */
    $(".door").click(function() {
        var door_id = $(this).attr('id');
        var classname = "";

        // add relevant class
        switch (door_id) {
        /*    case "d1-1":
            case "d1-2":
            case "d4-1":
            case "d4-2":*/
            case "d1":
            case "d4":
            case "d7":
                classname = "opendoorleft";
                break;
           /* case "d2-1":
            case "d2-2":
            case "d3-1":
            case "d3-2":
            case "d5-1":
            case "d5-2":*/
            case "d2":
            case "d3":
            case "d5":
            // case "d8":
                classname = "opendoorright";
                break;
            case "d6-1":
            case "d6-2":
            case "d6-3":
            case "d6-4":
            case "d6-5":
            case "d9-1":
            case "d9-2":
            case "d9-3":
            case "d10-1":
            case "d10-2":
            case "d10-3":
                classname = "opendrawer";
                break;
            case "d8":
                classname = "opendoordown";
                break;
            default:
                classname = "";
        }

        door_id = "#" + door_id;
        var schrank_id = door_id.replace("d", "s");


        // console.log("schrank_id " + schrank_id);
        var shelf_id = door_id.replace("d", "sv");

        if ($(door_id).hasClass(classname)) {
            $(door_id).removeClass(classname);
            $(schrank_id).css('display', 'none');
            // $(door_id).html((schrank_id.substr(1)).toUpperCase());
            // $('#test2').css('display', 'none');

            $('#test2').hide();
        } else {
            $(door_id).addClass(classname);
            $(schrank_id).css('display', 'block');
            $(door_id).html("");

            var l_doors = all_door_ids.length;
            for (var i = 0; i < l_doors; i++) {
                var curr_d = "#" + all_door_ids[i];
                var curr_s = curr_d.replace("d", "s");

                if (curr_d != door_id){
                    $(curr_d).removeClass("opendoorleft");
                    $(curr_d).removeClass("opendoorright");
                    $(curr_d).removeClass("opendrawer");
                    $(curr_d).removeClass("opendoordown");
                    $(curr_s).css('display', 'none');
                    // $(curr_d).html((curr_s.substr(1)).toUpperCase());
                }
            }
            last_open_shelf = shelf_id;
            // showObjects(last_open_shelf);
            // $('#test2').css('display', 'block');
            // $('#test2').show();
        }

    });

});


/* set object offset */
var setOffset = function(height, width, depth){
    return "min-height:" + height + "px;min-width:" + width + "px;perspective:" + depth + "px;";
}

/* calculate object scale factor */
var scaleFactor = function(obj_width, obj_height, parent_width, parent_height){

    var scale_width = Math.round((obj_width / parent_width) * 100) / 100;
    var scale_height = Math.round((obj_height / parent_height) * 100) / 100;
    scale_width = Math.min(scale_width, 0.5);
    scale_height = Math.min(scale_height, 0.5);

    var scale_factor = Math.round(((scale_height + +scale_width) / 2) * 100) / 100;
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

/* zeige Gegenstände unten an*/
function showObjects(last_shelf) {

    // Durch das if werden die oberen Schränke abgefangen, da diese nur eine Tür aber zwei Regale
    // besitzen. Um beide darzustellen wird der Kasten unten aufgeteilt.
    if ( last_shelf.match(/(\#sv\-[1-5])/g)
        // (last_shelf == "#sv1") || (last_shelf == "#sv2")
        // || (last_shelf == "#sv3") || (last_shelf == "#sv4") || (last_shelf == "#sv5")
        ){

        console.log(' in ' + last_shelf.match(/(\#sv\-[1-5])/g) + " + " + last_shelf);
        var last_shelf1 = last_shelf + "-1";
        var last_shelf2 = last_shelf + "-2";

        $cloned_shelf1 = $(last_shelf1).clone();
        $cloned_shelf1.css('width', 650).css('height', 245);
        $("img", $cloned_shelf1).css('height', 100).css('width', 100);
        $("img", $cloned_shelf1).css('margin', 2);
        $cloned_shelf1.appendTo("#test2");

        $cloned_shelf2 = $(last_shelf2).clone();
        $cloned_shelf2.css('width', 650).css('height', 245).css('left', 652).css('top', -89);
        $("img", $cloned_shelf2).css('height', 100).css('width', 100);
        $("img", $cloned_shelf2).css('margin', 2);
        $cloned_shelf2.appendTo("#test2");

        $("#test2").children().not($last_shelf1, $last_shelf2).remove();
    } else {
        console.log('out ' + last_shelf.match(/(\#sv\-[1-5])/g) + " + " + last_shelf);
        // bei den restlichen Regalen gilt: klone den inhalt des divs, verändere seine
        // css-Attribute width, height und vergrößere die images innerhalb des divs
        // füge anschließend den kopierten und modifizierten div dem Kasten hinzu
        $("#test2").empty();

        var $cloned_shelf;
        if ($(last_shelf).hasClass('obfl')) {
            if (last_shelf === "#obfl3" || $(last_shelf).hasClass('obfl')) {
                // console.log("last shelf: " + last_shelf);
                // $cloned_shelf = $(last_shelf).clone();
                $cloned_shelf = $(last_shelf).clone();
            } else {
                return;
            }
        } else if (!$(last_shelf).hasClass('obfl')){
            $cloned_shelf = $(last_shelf).clone();
        }

        $cloned_shelf.css('width', 900).css('height', 250);
        $cloned_shelf.css('margin-top', 0);
        $("img", $cloned_shelf).css('height', 100).css('width', 100);
        $("img", $cloned_shelf).css('margin', 2);
        $cloned_shelf.appendTo("#test2");
        $("#test2").children().not(last_shelf).remove();

        if (last_shelf === "#obfl3" || $(last_shelf).hasClass('obfl')) {
            $cloned_shelf.prop("id", last_shelf.substr(1) + Math.floor(Math.random() * 10) + 1);
        }

        let $buttonClose = ' <button class="closeAnzeige" id="close-anzeige"><h4>X</h4></button>';
        $('#test2').append($buttonClose);

        if($(last_shelf).hasClass('oben')) {
            $("#test2").css('top', '436px');
        } else if($(last_shelf).hasClass('unten')) {
            $("#test2").css('top','60px');
        }
        $('#test2').show();
    }
}


$(document).on('click', '.closeAnzeige#close-anzeige', function(){
    $("#test2").hide();
});
$(document).on('click', '.closeAnzeige#close-hilfe', function(){
    $("#info").hide();
});
$(document).on('click', '#help', function(){
    $("#info").show();
});

$(document).on('click', '#gkitchen .regal', function(){
    showObjects("#" + this.id);
    // console.log(this.id);
    // $("#test2").show();
});