// global values
var countClicks = 0;
var num_of_clicks_on_obj = 0;
var startTime = new Date();
var endTime = startTime;
let totallyFinished = false;

let timeLimitReached = false;
let timeLimitReachedString = "";
Date.prototype.getUnixTime = function() { return this.getTime()/1000|0 };

var timeLimit = function() {
    clearInterval(myInterval);

    if ($('#obj').find('img.objekte').length !== 0){
        $(".all").addClass("hidden");
        $('body').append('<img src="img/logo_web.png" id="logo"> \n' +
            '<p id="expstart"><b>Du hast das Zeit-Limit erreicht und nicht alle Objekte eingeräumt. Der Versuch ist nun zu Ende.</p><br><br>' +
            'Bitte beginne den Versuch <a href="index.php">erneut</a>.<br><br>' +
            '<hr>' +
            '<span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>')
    } else {
        $('#obj').css('opacity','0.7').unbind();
        $('#obj .objekte').unbind();
        $('#obj .objekte:hover').css('cursor','initial');

        timeLimitReached = true;
        timeLimitReachedString = "Du hast das Zeit-Limit erreicht. Der Versuch ist nun zu Ende. <br><br>";
        document.getElementById('finish').disabled = false;
        $('#finish').click();
    }


};

let interval = 1000 * 60 * 60; // where X is your every X minutes

let myInterval = setInterval(timeLimit, interval);



// var regal_ids = ["time/ID","sv1-1","sv1-2","sv2-1","sv2-2","sv3-1","sv3-2","sv4-1","sv4-2","sv5-1",
//     "sv5-2","sv6-1","sv6-2","sv6-3","sv6-4","sv6-5","sv7","sv8","sv9-1","sv9-2","sv9-3",
//     "sv10-1","sv10-2","sv10-3","obfl1","obfl2","obfl3","obfl4","obfl5","obj","sv11"];
var regal_ids = ["time/ID","sv1-1","sv1-2","sv2-1","sv2-2","sv3-1","sv3-2","sv4-1","sv4-2","sv5-1",
    "sv5-2","sv6-1","sv6-2","sv6-3","sv6-4","sv6-5","sv7","sv8","sv9-1","sv9-2","sv9-3",
    "sv10-1","sv10-2","sv10-3","obfl1","obfl2","obfl3","obfl4","obfl5","obj"];
// speihert aktuellen Zustand (Elemente werden bei back-Button NICHT entfernt)
var results = new Array();
var resultsForDB = [];
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

    // $('.regal').draggable();



    /* make shelves sortable */
    // $('.regal').sortable({
    $('.regalSort').sortable({
        connectWith: '.regalSort',
        placeholder: 'objekte',
        revert: 50,
        appendTo: "body",
        helper: "clone",
        // helper: function (e, item) {
        //     //Basically, if you grab an unhighlighted item to drag, it will deselect (unhighlight) everything else
        //     if (!item.hasClass('selected-multiple')) {
        //         item.addClass('selected-multiple').siblings().removeClass('selected-multiple');
        //     }
        //
        //     //////////////////////////////////////////////////////////////////////
        //     //HERE'S HOW TO PASS THE SELECTED ITEMS TO THE `stop()` FUNCTION:
        //
        //     //Clone the selected items into an array
        //     var elements = item.parent().children('.selected-multiple').clone();
        //
        //     //Add a property to `item` called 'multidrag` that contains the
        //     //  selected items, then remove the selected items from the source list
        //     item.data('multidrag', elements).siblings('.selected-multiple').remove();
        //
        //     //Now the selected items exist in memory, attached to the `item`,
        //     //  so we can access them later when we get to the `stop()` callback
        //
        //
        //     //Create the helper
        //     var helper = $('<div/>');
        //     return helper.append(elements);
        // },

        start: function(event, ui) {
            // sortableStart(event,ui)
            // var elements = ui.item.data('multidrag');

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
            ui.placeholder.css('visibility', 'visible');
        },
        stop: function(event, ui) {
            // var elements = ui.item.data('multidrag');
            // console.log("stop, elem 0 " + elements[0].attr('id'));
            // sortableStop(event,ui)
            /* put and scale object */

            let curObjTooLargeOrFull = false;
            let old = false;
            var old_parent_id = $(event.target).attr("id");
            var new_parent_id = ui.item.parent().attr("id");

            if ($('#' + new_parent_id).parent('#test2').length) {
                if (new_parent_id.startsWith('sv7') || new_parent_id.startsWith('sv8')){
                    new_parent_id = new_parent_id.substr(0,3);
                    console.log('#test2 1');
                } else if (new_parent_id.startsWith('sv10')){
                    new_parent_id = new_parent_id.substr(0,6);
                    console.log('#test2 2');
                } else {
                    new_parent_id = new_parent_id.substr(0,5);
                    console.log('#test2 3');
                }
                console.log("new_parent_id " + new_parent_id);
                $('#' + new_parent_id).append(ui.item);
            }


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


            if (old_parent_id.startsWith(new_parent_id) &&
                ($('#' + old_parent_id).parent('#test2').length)){
                $('#' + old_parent_id).find(ui.item).remove();

            }
            else if (new_parent_id.startsWith(old_parent_id) &&
                ($('#' + new_parent_id).parent('#test2').length)) {
                $('#' + old_parent_id).append(ui.item);
                old = true;
            } else if ((old_parent_id !== new_parent_id)) {

                if (new_parent_id === 'obj') {
                    ui.item.css('width', 100);
                    ui.item.css('height', 100);
                } else {
                    if (obj_height > parent_height) {
                        $('#' + old_parent_id).append(ui.item);
                        // document.getElementById('myModalAlert').style.display = "block";

                        $("#myModalAlert").css('opacity', '0');
                        $('#myModalAlert').css('display','block');
                        $("#myModalAlert").css('opacity', '1');
                        // $('#myModalAlert').animate({opacity: 1}, 100);

                        $('#myModalAlert #alertText').html("Passt nicht rein!");
                        curObjTooLargeOrFull = true;
                        // alert("Passt nicht rein!");
                    } else {
                        console.log("old yes 033");
                        if ( regal_volume >= placeholder_volume ) {
                            console.log("old yes 033a");

                            ui.item.css('width', 100);
                            ui.item.css('height', 100);

                            //Skalierung momentan auf 50% der Größe in der Liste
                            ui.item.css('width', 50);
                            ui.item.css('height', 50);
                            ui.item.css('horizontal-align','bottom');
                        } else {
                            console.log("old yes 033b");
                            $('#' + old_parent_id).append(ui.item);
                            // document.getElementById('myModalAlert').style.display = "block";
                            // $('#myModalAlert').fadeIn(300);
                            // $('#myModalAlert').css('opacity', '1').css('display', 'block');
                            // $('#myModalAlert').css('visibility','visible');
                            // $('#myModalAlert').css('opacity','1');
                            $('#myModalAlert').css('opacity','1');
                            $('#myModalAlert').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                                function(e) {
                                    $('#myModalAlert').css('display','block');
                                });
                            $('#myModalAlert #alertText').html("Kein Platz mehr!");
                            curObjTooLargeOrFull = true;
                            // alert("Kein Platz mehr!");
                        }
                    }
                }
            }

            if(new_parent_id !== 'obj') {
                let resTmp = [];
                resTmp[0] = userid;
                resTmp[1] = new_parent_id;
                resTmp[2] = new Date().getUnixTime();
                resTmp[3] = obj_id;
                resTmp[4] = 1;
                resultsForDB.push(resTmp);

                // console.log('resultsForDB ' + JSON.stringify(resultsForDB));

                let res= [];
                resultsForDB.forEach(function each(item) {
                    if((item[0] === userid) && (item[3] === obj_id)
                        && (item[2] < resTmp[2])) {
                        item[4] = 0;
                    }
                    res.push(item);
                });

                resultsForDB = res;
                // console.log('resultsForDB filtered: ' + JSON.stringify(resultsForDB));
            }


            // save current state in results - array
            var n = results.length;
            var l = regal_ids.length;
            results[n] = new Array();
            results[n][0] = timeToString(new Date());

            for (var i = 1; i < l; i++){

                var children = [];
                $("#" + regal_ids[i]).children().each( function (){
                    if ($(this).attr('id') !== 'myModalObj') {
                        children.push($(this).attr('id'));
                    }
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
            // console.log("add, results: \n" + JSON.stringify(results));
            $(".regal").css('opacity', 1);

            // Klasse 'hasObjects' wird wieder entfernt, wenn Begründung eingegeben wird
            // if (new_parent_id !== 'obj') {
            //     $('#' + new_parent_id).addClass('hasObjects');
            // }
            // Objekte unten im Extra-Fenster anzeigen
           /* if((new_parent_id !== 'obj') && !curObjTooLargeOrFull) {
                $('#' + new_parent_id).addClass('hasObjects');
                showObjects("#" + new_parent_id);
            }*/
            if((new_parent_id !== 'obj') && !curObjTooLargeOrFull) {
                if (old) {
                    showObjects("#" + old_parent_id);
                }else {
                    $('#' + new_parent_id).addClass('hasObjects');
                    showObjects("#" + new_parent_id);
                }
            } else {
                console.log("not showing objects");
            }
            // console.log("new_parent_id " + new_parent_id);
            // console.log("\n this.id " + this.id);

            if($('#' + old_parent_id).find('img.objekte').length === 0) {
                $('#' + old_parent_id).removeClass('hasObjects');
            }


            if ($('#obj').find('img.objekte').length === 0) {
                document.getElementById('finish').disabled = false;
                console.log("finish enabled");
            } else {
                document.getElementById('finish').disabled = true;
                console.log("finish disabled");
            }
            // document.getElementById('back').disabled = false;
        },
    });

    /* wenn 'back' solange gedrückt wurde, bis keine Gegenstände mehr in den Regalen/auf den Oberflächen sind*/
    function allImagesRightInObjClearAllShelves() {
        for (let j = 1; j < regal_ids.length-1; j++) {
            $("#" + regal_ids[j]).empty();
        }
        $('#test2').children('div').empty();
        let $buttonClose = ' <button class="closeAnzeige" id="close-anzeige"><h4>X</h4></button>';
        $('#test2').append($buttonClose);

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

        if((index > 0) && (results[index][1] === "RESTART")) {
            allImagesRightInObjClearAllShelves();
        } else if((index > 0) && !(results[index][1] === "RESTART")) {
        // if ( index > 0 ) {
            // console.log("index right after click " + index);
            index--;
            if (index <= 0) {index = 0}
            // console.log("index right after decr " + index);
            $(".regal").html("");
            var l = regal_ids.length;
            // if(results[index][1] === "RESTART") {
            //     allImagesRightInObjClearAllShelves();
            // }
            // while (results[index][1] === "RESTART") {
            //     index--;
            // }

            // console.log("restart before, results: \n" + JSON.stringify(results));
            // console.log("\n daten " + JSON.stringify(daten));
            for ( var i = 1; i < l; i++ ) {

                var children = results[index][i];
                // console.log("children before split " +JSON.stringify(children));
                children = children.split(",");
                var l2 = children.length;
                // console.log("\n children after split " +JSON.stringify(children));

                for (let j = 0; j < l2; j++) {

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
                if (($('#test2').children("#" + regal_ids[i]).length > 0) && ($('#test2').css('display') !== 'none')) {
                    let c = $('test2 #' + regal_ids[i]).attr('id');
                    let cl = 0;
                    // console.log("show: #" + regal_ids[i]);
                    // for (let i = 0; i < c.length; i++) {
                    showObjects("#" + regal_ids[i]);
                    // }
                }
            }
            // console.log("$('test2').find(\".regal\")[0].id: " + $('test2').find(".regal"));
            // if ($('test2').find(".regal").length > 0) {
            //     let c = $('test2').find(".regal");
            //     let cl = 0;
            //     console.log("c[cl].id " + c[cl].id);
            //     // for (let i = 0; i < c.length; i++) {
            //         showObjects("#" + c[cl].id);
            //     // }
            // }
        } else if (index === 0 ) {
            allImagesRightInObjClearAllShelves();
        }
    });

    /* Redo */
    $("#next").click(function() {
        document.getElementById('back').disabled = false;
        if((index < results.length) && (results[index][1] === "RESTART")) {
            allImagesRightInObjClearAllShelves();
        } else if((index < results.length) && !(results[index][1] === "RESTART")) {
        // if ( index < results.length ) {
            // console.log("next, index right after click " + index);

            if (index >= results.length-1) {
                document.getElementById('next').disabled = true;
            }

            $(".regal").html("");
            var l = regal_ids.length;


            // while (results[index][1] === "RESTART") {
            //     index++;
            // }

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
                if (($('#test2').children("#" + regal_ids[i]).length > 0) && ($('#test2').css('display') !== 'none')) {
                    let c = $('test2 #' + regal_ids[i]).attr('id');
                    let cl = 0;
                    // console.log("show: #" + regal_ids[i]);
                    // for (let i = 0; i < c.length; i++) {
                    showObjects("#" + regal_ids[i]);
                    // }
                }
            }
            index++;
            // console.log("next, index right after incr " + index);
            // if (document.getElementById("test2").childNodes.length > 0) {
            //     let c = document.getElementById("test2").childNodes;
            //     // for (let i = 0; i < c.length; i++) {
            //         showObjects("#" + c[c.length-2].id);
            //     // }
            //
            // }
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
        // $(".schrank").css('display', 'none');

        // $('#test2').css('display', 'none');
        $('#test2').fadeOut(300);
    });

    /* reload the kitchen */
    $('#refresh').click(function() {
        window.location.reload(false);
    });
    /* OLD version, where page is not reloaded*/
    $('#refresh_old').click(function() {
        // var l = regal_ids.length;
        allImagesRightInObjClearAllShelves();

        var n = results.length;
        var l = regal_ids.length;
        results[n] = new Array();
        results[n][0] = timeToString(new Date()) + ",RESTART";

        for (var i = 1; i < l; i++) {
            var children = [];
            $("#" + regal_ids[i]).children().each(function () {
                if ($(this).attr('id') !== 'myModalObj') {
                    children.push($(this).attr('id'));
                }
            });
            results[n][i] = children.toString();
        }

        if(results[n] !== null) {results_history_change[n] = results[n];}
        // var tmp = new Array(l);
        // tmp[0] = timeToString(new Date());
        // tmp[1] = 'RESTART';
        // results.push(tmp);
        // results_history_change.push(tmp);
        index = results.length-1;
        console.log("reload, results:\n " + JSON.stringify(results));
        // location.reload();
        // $(".regal").html("");



        // for (var i = 0; i < daten.length; i++){
        //     var offset = setOffset(daten[i][3], daten[i][4], daten[i][5]);
        //     $("#obj").append('<img class="objekte" id="' + daten[i][0] + '" src="150px_Bilder/' + daten[i][2] + '" alt="' + daten[i][1] + '" style="' + offset + '"/>')
        // }

        // close doors
        $(".door").animate({opacity:'1'});
        $(".door").css('z-index', '1');

        $(".door").removeClass("opendoorleft");
        $(".door").removeClass("opendoorright");
        $(".door").removeClass("opendrawer");
        $(".door").removeClass("opendoorup");
        $(".door").removeClass("opendoordown");

        $(".schrank").css('z-index', '0');
        $(".schrank").css('display', 'none');
        // for (var i = 1; i < 13; i++){
        //     $("#d"+i).html("S"+i);
        // }

    });


    let allExplanationsWritten = false;
    let endtime;
    /* finish the simulation and send user data via ajax */
    $('#finish').click(function(){

        if (!totallyFinished && !allExplanationsWritten) {
            endTime = new Date();
            $('#test2').hide();
            $('#test2').css('height', '330px');
            $('#gkitchen .regal:not(#test2 .regal)').prepend('<div class="erkl"><h4>Erklärung:</h4><textarea></textarea></div>');
            $('#myModalAlert #alertText').html(timeLimitReachedString + "Bitte gib zu jedem Regalfach eine kurze Erklärung, " +
                "warum du die Gegenstände zusammen gruppiert hast.<br>" +
                "Klicke in ein Regalfach, um seinen Inhalt zu begründen. Deine Eingabe wird automatisch gespeichert.<br><br>" +
                "Drücke anschließend erneut auf \"Weiter\".");
            $("#myModalAlert div").css({
                width:'400px',
                height: '265px'});
            if (timeLimitReached) {$("#myModalAlert div").css({height: '315px'}); }
            $("#myModalAlert").css('opacity', '0');
            $('#myModalAlert').css('display','block');
            $("#myModalAlert").css('opacity', '1');

            $("#open").click();

            $('.regal').removeClass('hasObjectsActive');
            $('.hasObjects').addClass('hasObjectsBorder');
            $('.regalSort').sortable('destroy').unbind();


            $(document).on('click', '#gkitchen .regal:not(#test2 .regal)', function(){
                // showObjects("#" + this.id);
                $('#test2 .erkl').css('display', 'block');
                $('#test2 .regal').css('height', '330px');
                if($(this).hasClass('oben')) {
                    $('#test2').css('top', '295px');
                }
            });

            $(document).on('input propertychange', '#test2 .erkl textarea', function () {
                let parent = $(this).closest('.regal');
                let parentID = parent.attr('id');

                if (parentID.startsWith('sv7') || parentID.startsWith('sv8')){
                    parentID = parentID.substr(0,3);
                } else if (parentID.startsWith('sv10')){
                    parentID = parentID.substr(0,6);
                } else {
                    parentID = parentID.substr(0,5);
                }

                $('#' +parentID + ' .erkl textarea').val($(this).val());

                if ($(this).val() !== "") {
                    parent.removeClass('hasObjects');
                    parent.removeClass('hasObjectsBorder');
                    $('#' + parentID).removeClass('hasObjects').removeClass('hasObjectsBorder');
                } else {
                    parent.addClass('hasObjects');
                    parent.addClass('hasObjectsBorder');
                    $('#' + parentID).addClass('hasObjects').addClass('hasObjectsBorder');
                }

                console.log('parentID ' + parentID);
            });

            totallyFinished = true;
            // (totallyFinished && !allExplanationsWritten)
        } else if(totallyFinished) {
            // $('.hasObjects textarea').each(function(i, obj) {
            if($('.hasObjects').length) {
                // if (obj.value === "") {
                    $('#myModalAlert #alertText').html("Bitte begründe zuerst deine Auswahl für jedes eingeräumte Fach!<br><br>" +
                        "Klicke in ein Regalfach, um seinen Inhalt zu begründen. Deine Eingabe wird automatisch gespeichert.<br><br>" // TO-DO: ergänzen: Klicke in ein Regalfach, um seinen Inhalt zu begründen. Deine Eingabe wird automatisch gespeichert [sofern das der Fall ist].
                        + "Drücke anschließend erneut auf \"Weiter\"."); // TO-DO: das Beschreibungsfeld oberhalb der Bildchen anzeigen lassen
                    $("#myModalAlert div").css({
                        width:'400px',
                        height: '265px'});
                    $('#myModalAlert button').css('top', '0');
                    $("#myModalAlert").css('opacity', '0').css('display','block').css('opacity', '1');
                    allExplanationsWritten = false;
                    return;
            }
            // else {
            //    allExplanationsWritten = true;
            // }
            // });

        // } else {

            var n = results.length;
            var l = regal_ids.length;
            let reasons = new Array();
            reasons[0] = timeToString(new Date());

            for (var i = 1; i < l; i++){

                // var children = [];
                $("#" + regal_ids[i] + " .erkl textarea").each( function (){

                        reasons.push($(this).val());

                });
                // reasons[i] = children.toString();
            }

            // console.log(JSON.stringify(reasons));



            row.unshift('save');
            // let endTime = new Date();
            let timeDiff = (endTime-startTime);
            row.push(timeToString(startTime), timeToString(endTime), msecToString(timeDiff), countClicks, num_of_clicks_on_obj);
            // row.push(timeToString(startTime), timeToString(new Date()), countClicks, num_of_clicks_on_obj);

            $.ajax({
                type: 'POST',
                url: this.url,
                // url: './db/uploadResPlusCSV.php',
                data: {
                    arr1 : row,
                    arr2 : results,
                    arr3 : regal_ids,
                    arr4 : reasons,
                    arr5 : resultsForDB
                },
                success: function(data) {
                    console.log(data);
                    $(".all").addClass("hidden");
                    // $("h3").removeClass("hidden");
                    window.location.href = 'finish.php';
                },
                completed: function(data){
                    // window.location.href = 'finish.php';
                }
            });
        }




        //location.reload();
        // screenshot
        // $('.all').html2canvas({
        //     onrendered: function (canvas) {
        //         var url = canvas.toDataURL("image/png").replace(/^data:image\/[^;]/, 'data:application/octet-stream');
        //         location.href = url;
        //     }
        // });


        // html2canvas(document.querySelector(".all")[0]).then(canvas => {
        //     // document.body.appendChild(canvas);
        //     let url = canvas.toDataURL("image/png");
        //         // .replace(/^data:image\/[^;]/, 'data:application/octet-stream');
        //     location.href = url;
        // });


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
        let classname = "";
        let classClosed = '';
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
                classClosed = "opendoorrightClosed";
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
                classClosed ="opendoordownClosed";
                break;
            default:
                classname = "";
        }

        door_id = "#" + door_id;
        var schrank_id = door_id.replace("d", "s");



        var shelf_id = door_id.replace("d", "sv");
        console.log("shelf_id " + shelf_id);

        if ($(door_id).hasClass(classname)) {
            $(door_id).removeClass(classname);
            $(door_id).addClass(classClosed);
            // $(schrank_id).css('display', 'none');
            // $(schrank_id).fadeOut(700);
            // $(door_id).html((schrank_id.substr(1)).toUpperCase());
            // $('#test2').css('display', 'none');

            // $('#test2').hide();
            if (shelf_id.startsWith('#sv2') || shelf_id.startsWith('#sv3')
                || shelf_id.startsWith('#sv4') || shelf_id.startsWith('#sv5')){

                $(shelf_id + '-1').removeClass('regalSort').sortable('destroy').unbind();
                $(shelf_id + '-2').removeClass('regalSort').sortable('destroy').unbind();

                // $(shelf_id + '-1').disableSelection('disabled').unbind('click').unbind('mousedown').unbind('mouseup').unbind('selectstart');
                // $(shelf_id + '-2').disableSelection('disabled').unbind('click').unbind('mousedown').unbind('mouseup').unbind('selectstart');

            } else {
                $(shelf_id).removeClass('regalSort').sortable('destroy').unbind();
                // $(shelf_id).disableSelection('disabled').unbind('click').unbind('mousedown').unbind('mouseup').unbind('selectstart');

            }


            $('#test2').css('opacity', '0').css('display', 'none');
        } else {
            $(door_id).removeClass(classClosed);
            $(door_id).addClass(classname);
            // $(schrank_id).css('display', 'block');
            // $(schrank_id).fadeIn(300);
            $(door_id).html("");

            // wenn nicht aus kommentiert, werden alle anderen Türen geschlossen
            /*var l_doors = all_door_ids.length;
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
            }*/
            last_open_shelf = shelf_id;

            if (shelf_id.startsWith('#sv2') || shelf_id.startsWith('#sv3')
                || shelf_id.startsWith('#sv4') || shelf_id.startsWith('#sv5')){

                $(shelf_id + '-1').addClass('regalSort').removeClass("ui-sortable-disabled");
                $(shelf_id + '-2').addClass('regalSort').removeClass("ui-sortable-disabled");

                // if ($(shelf_id+ '-1').sortable( "option", "disabled" ) === 'true') {
                //     $(shelf_id+ '-1').sortable("enable");
                //     $(shelf_id+ '-2').sortable("enable");
                // }

               /* $(shelf_id + '-1').sortable("enable",{
                    connectWith: shelf_id + '-1',
                    placeholder: 'objekte',
                    revert: 50,
                    start: function(event, ui) {
                        sortableStartInTest2(event,ui)
                    },
                    stop: function(event, ui) {
                        sortableStopInTest2(event,ui)
                    }
                });
                $(shelf_id + '-2').sortable("enable",{
                    connectWith: shelf_id + '-2',
                    placeholder: 'objekte',
                    revert: 50,
                    start: function(event, ui) {
                        sortableStartInTest2(event,ui)
                    },
                    stop: function(event, ui) {
                        sortableStopInTest2(event,ui)
                    }
                });*/

            } else {
                $(shelf_id).addClass('regalSort').removeClass("ui-sortable-disabled");

                // if ($(shelf_id).sortable( "option", "disabled" ) === 'true') {
                //     $(shelf_id).sortable("enable");
                // }
               /* $(shelf_id).sortable("enable",{
                    connectWith: shelf_id,
                    placeholder: 'objekte',
                    disable: false,
                    revert: 50,
                    start: function(event, ui) {
                        sortableStartInTest2(event,ui)
                    },
                    stop: function(event, ui) {
                        sortableStopInTest2(event,ui)
                    }
                });*/
            }
            // console.log("shelf_id " + shelf_id + " after");


            $('.regalSort').sortable({
                connectWith: '.regalSort',
                placeholder: 'objekte',
                revert: 50,
                start: function(event, ui) {
                    sortableStartInTest2(event,ui)
                },
                stop: function(event, ui) {
                    sortableStopInTest2(event,ui)
                }
            });
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
};

// add zero if date less then 10
var convertDate = function(d){
    return (d < 10)? ("0" + d) : d;
};

// time to string
var timeToString = function(d){
    return convertDate(d.getHours()) + ":" + convertDate(d.getMinutes()) + ":" + convertDate(d.getSeconds());
};

let msecToString = function (diff) {
    let msec = diff;
    let hh = Math.floor(msec / 1000 / 60 / 60);
    msec -= hh * 1000 * 60 * 60;
    let mm = Math.floor(msec / 1000 / 60);
    msec -= mm * 1000 * 60;
    let ss = Math.floor(msec / 1000);
    msec -= ss * 1000;
    return hh + ":" + mm + ":" + ss;

};




    /* hide kitchen object(s) */
var hideImage = function(id) {
    $(id).addClass('transparent');
};

/* show kitchen object(s) */
var showImage = function(id) {
    $(id).removeClass('transparent');
};


function sortableStartInTest2(event,ui) {
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
}

function sortableStopInTest2(event,ui) {
    let curObjTooLargeOrFull = false;
    let old = false;
    var old_parent_id = $(event.target).attr("id");
    var new_parent_id = ui.item.parent().attr("id");

    if (old_parent_id.startsWith('sv7') || old_parent_id.startsWith('sv8')){
        old_parent_id = old_parent_id.substr(0,3);
    } else if (old_parent_id.startsWith('sv10')){
        old_parent_id = old_parent_id.substr(0,6);
    } else {
        old_parent_id = old_parent_id.substr(0,5);
    }
    console.log('old_parent_id ' + old_parent_id);
    console.log('new_parent_id ' + new_parent_id);


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


   if (old_parent_id.startsWith(new_parent_id)){
        $('#' + old_parent_id).find(ui.item).remove();
       console.log("old 1");
    }
    else if (new_parent_id.startsWith(old_parent_id) &&
        ($('#' + new_parent_id).parent('#test2').length)) {
       $('#' + new_parent_id).append(ui.item);

        old = true;
       console.log("old yes 2");
    } else if ((old_parent_id !== new_parent_id)) {
       if ($('#' + new_parent_id).parent('#test2').length) {
           if (new_parent_id.startsWith('sv7') || new_parent_id.startsWith('sv8')){
               new_parent_id = new_parent_id.substr(0,3);
               console.log('#test2 10');
           } else if (new_parent_id.startsWith('sv10')){
               new_parent_id = new_parent_id.substr(0,6);
               console.log('#test2 20');
           } else {
               new_parent_id = new_parent_id.substr(0,5);
               console.log('#test2 30');
           }
           console.log("new_parent_id 0" + new_parent_id);
           $('#' + new_parent_id).append(ui.item);
       }




        console.log("old yes 3");
        if (new_parent_id === 'obj') {
            ui.item.css('width', 100);
            ui.item.css('height', 100);
            $('#' + old_parent_id + ' #'+ obj_id).remove();
        } else {
            if (obj_height > parent_height) {
                $('#' + old_parent_id).append(ui.item);
                // document.getElementById('myModalAlert').style.display = "block";
                $('#myModalAlert #alertText').html("Passt nicht rein!");
                $("#myModalAlert").css('opacity', '0').css('display','block').css('opacity', '1');
                // $('#myModalAlert').animate({opacity: 1}, 100);


                curObjTooLargeOrFull = true;
                // alert("Passt nicht rein!");
            } else {
                if (regal_volume >= placeholder_volume ) {

                    ui.item.css('width', 100);
                    ui.item.css('height', 100);

                    //Skalierung momentan auf 50% der Größe in der Liste
                    ui.item.css('width', 50);
                    ui.item.css('height', 50);
                    ui.item.css('horizontal-align','bottom');
                    $('#' + old_parent_id + ' #'+ obj_id).remove();
                } else {
                    $('#' + old_parent_id).append(ui.item);
                    // document.getElementById('myModalAlert').style.display = "block";
                    // $('#myModalAlert').fadeIn(300);
                    // $('#myModalAlert').css('opacity', '1').css('display', 'block');
                    // $('#myModalAlert').css('visibility','visible');
                    // $('#myModalAlert').css('opacity','1');
                    $('#myModalAlert').css('opacity','1');
                    $('#myModalAlert').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                        function(e) {
                            $('#myModalAlert').css('display','block');
                        });
                    $('#myModalAlert #alertText').html("Kein Platz mehr!");
                    curObjTooLargeOrFull = true;
                    // alert("Kein Platz mehr!");
                }
            }
        }

    }
    if(new_parent_id !== 'obj') {
        let resTmp = [];
        resTmp[0] = userid;
        resTmp[1] = new_parent_id;
        resTmp[2] = new Date().getUnixTime();
        resTmp[3] = obj_id;
        resTmp[4] = 1;
        resultsForDB.push(resTmp);

        console.log('resultsForDB ' + JSON.stringify(resultsForDB));

        let res= [];
        resultsForDB.forEach(function each(item) {
            if((item[0] === userid) && (item[3] === obj_id)
                && (item[2] < resTmp[2])) {
                item[4] = 0;
            }
            res.push(item);
        });

        resultsForDB = res;
        // console.log('resultsForDB filtered: ' + JSON.stringify(resultsForDB));
    }




    // save current state in results - array
    var n = results.length;
    var l = regal_ids.length;
    results[n] = new Array();
    results[n][0] = timeToString(new Date());

    for (var i = 1; i < l; i++){

        var children = [];
        $("#" + regal_ids[i]).children().each( function (){
            if ($(this).attr('id') !== 'myModalObj') {
                children.push($(this).attr('id'));
            }
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
    // console.log("add, results: \n" + JSON.stringify(results));
    $(".regal").css('opacity', 1);

    // Klasse 'hasObjects' wird wieder entfernt, wenn Begründung eingegeben wird
    // if (new_parent_id !== 'obj') {
    //     $('#' + new_parent_id).addClass('hasObjects');
    // }
    // Objekte unten im Extra-Fenster anzeigen
    if((new_parent_id !== 'obj') && !curObjTooLargeOrFull) {
        if (old) {
            showObjects("#" + old_parent_id);
        }else {
            $('#' + new_parent_id).addClass('hasObjects');
            showObjects("#" + new_parent_id);
        }
    }
    // console.log("new_parent_id " + new_parent_id);
    // console.log("\n this.id " + this.id);

    if($('#' + old_parent_id).find('img.objekte').length === 0) {
        $('#' + old_parent_id).removeClass('hasObjects');
    }


    if ($('#obj').find('img.objekte').length === 0) {
        document.getElementById('finish').disabled = false;
        console.log("finish enabled");
    } else {
        document.getElementById('finish').disabled = true;
        console.log("finish disabled");
    }
    // document.getElementById('back').disabled = false;
}

/* zeige Gegenstände unten an*/
function showObjects(last_shelf) {

    if($(last_shelf).hasClass('oben')) {
        $("#test2").css('top', '376px');
    } else if($(last_shelf).hasClass('unten')) {
        $("#test2").css('top','0');
    }
    // Durch das if werden die oberen Schränke abgefangen, da diese nur eine Tür aber zwei Regale
    // besitzen. Um beide darzustellen wird der Kasten unten aufgeteilt.
    // if ((last_shelf.search("#sv1") !== -1) || (last_shelf.search("#sv2") !== -1) ||
    //     (last_shelf.search("#sv3") !== -1) || (last_shelf.search("#sv4") !== -1) ||
    //         (last_shelf.search("#sv5") !== -1)
    //     // (last_shelf == "#sv1") ||    (last_shelf == "#sv2")
    //     // || (last_shelf == "#sv3") || (last_shelf == "#sv4") || (last_shelf == "#sv5")
    //     ){
    //     $("#test2").empty();
    //     last_shelf = last_shelf.substr(0,4);
    //     // console.log(' last shelf in ' + last_shelf);
    //     var last_shelf1 = last_shelf + "-1";
    //     var last_shelf2 = last_shelf + "-2";
    //     // console.log(' last shelf2 in ' + last_shelf2);
    //     let $cloned_shelf1 = $(last_shelf1).clone();
    //     // console.log("$(last_shelf1).clone() " + JSON.stringify($(last_shelf1).clone()));
    //     $cloned_shelf1.css('width', 900).css('height', 125).css('margin-top', 0);
    //     $("img", $cloned_shelf1).css('height', 100).css('width', 100);
    //     $("img", $cloned_shelf1).css('margin', 2);
    //     $cloned_shelf1.appendTo("#test2");
    //
    //     let $cloned_shelf2 = $(last_shelf2).clone();
    //     // console.log("typeof $(last_shelf2).clone() " + typeof $(last_shelf2).clone());
    //     // console.log("$(last_shelf2).clone() " + JSON.stringify($(last_shelf2).clone()));
    //     $cloned_shelf2.css('width', 900).css('height', 125).css('top', 125).css('margin-top', 0);
    //     $("img", $cloned_shelf2).css('height', 100).css('width', 100);
    //     $("img", $cloned_shelf2).css('margin', 2);
    //     $cloned_shelf2.appendTo("#test2");
    //     // $("#test2").append($cloned_shelf2);
    //
    //     // $("#test2").children().not(last_shelf1, last_shelf2).remove();
    //     // $('#test2').show();
    // } else {
        // console.log('out ' + last_shelf.match(/(\#sv\-[1-5])/g) + " + " + last_shelf);
        // bei den restlichen Regalen gilt: klone den inhalt des divs, verändere seine
        // css-Attribute width, height und vergrößere die images innerhalb des divs
        // füge anschließend den kopierten und modifizierten div dem Kasten hinzu
        $("#test2").empty();

        // $('.regal').css('border', 'none');
        // $('#sv1-1, #sv2-1, #sv3-1, #sv4-1, #sv5-1').css({
        // borderBottom: 'solid #b6afaf',
        // borderWidth: '3px'});
        // $(last_shelf).css({border: '2px dashed #690000', boxSizing:'border-box'});

        if (!totallyFinished) {
            $('.regal').removeClass('hasObjectsActive');
            $(last_shelf).addClass('hasObjectsActive');
        }



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

        // if (last_shelf === "#obfl3" || $(last_shelf).hasClass('obfl')) {
        //     $cloned_shelf.prop("id", last_shelf.substr(1) + Math.floor(Math.random() * 10) + 1);
        // }
        $cloned_shelf.prop("id", last_shelf.substr(1) + Math.floor(Math.random() * 10) + 1);

        // let $buttonClose = ' <button class="closeAnzeige" id="close-anzeige"><h4>X</h4></button>';
        // $('#test2').append($buttonClose);
        //
        // if($(last_shelf).hasClass('oben')) {
        //     $("#test2").css('top', '436px');
        // } else if($(last_shelf).hasClass('unten')) {
        //     $("#test2").css('top','60px');
        // }
        // $('#test2').show();
    // }
    $('#test2 .regalSort').sortable({
        connectWith: '.regalSort',
        placeholder: 'objekte',
        revert: 50,
        appendTo: "body",
        helper: "clone",
        start: function(event, ui) {
            sortableStartInTest2(event,ui)
        },
        stop: function(event, ui) {
            sortableStopInTest2(event,ui)
            }
    });



    let $buttonClose = ' <button class="closeAnzeige" id="close-anzeige"><h4>X</h4></button>';
    $('#test2').append($buttonClose);

    let upDown = '<div class="testUpAndDown">\n' +
        '                <button id="testUp"><h4>&#10145;</h4></button><br>\n' +
        '                <button id="testDown"><h4>&#10145;</h4></button>\n' +
        '            </div>';
    $('#test2').append(upDown).css('opacity', '1').css('display', 'block');



    // $('#test2').show();

}
$(document).on('click', '#testUp', function(){
    let tT = document.getElementById('test2').style.top.replace(/\D/g,'');
    // let tT = $("#test2").offset().top;
    // console.log('tT ' + tT);

    let minusT = parseInt(tT) -40;
    // console.log('minusT ' + minusT);
    if(tT >= 40) {
        $("#test2").css({top: minusT + 'px'});
        $("#testDown").prop('disabled', false);
    } else {
        $("#testUp").prop('disabled', true);

    }

});
$(document).on('click', '#testDown', function(){
    let tTH = document.getElementById('test2').style.top.replace(/\D/g,'');
    // let tTH = $("#test2").offset().top;
    // console.log('tTH ' + tTH);

    let plusT = parseInt(tTH) +40;
    // console.log('plusT ' + plusT);
    if(tTH <= 360) {
        $("#test2").css({top: plusT + 'px'});
        $("#testUp").prop('disabled', false);
    } else {
        $("#testDown").prop('disabled', true);
    }

});

$(document).on('click', '.closeAnzeige#close-anzeige', function(){
    // $("#test2").css('opacity');
    // $("#test2").css('display');
    $("#test2").css('opacity', '0').css('display', 'none');
    if (!totallyFinished) {
        $('.regal').removeClass('hasObjectsActive');
    }
    // $('.regal').css('border', 'none');
    // $('#sv1-1, #sv2-1, #sv3-1, #sv4-1, #sv5-1').css({
    //    borderBottom: 'solid #b6afaf',
    //    borderWidth: '3px'});
});
$(document).on('click', '.closeAnzeige#close-hilfe', function(){
    $("#info").fadeOut(300);
});
$(document).on('click', '#help', function(){
    $("#info").fadeIn(300);
});

$(document).on('click', '#gkitchen .regal:not(#test2 .regal)', function(){
    showObjects("#" + this.id);
    // console.log(this.id);
    // $("#test2").show();
});


// adapted from https://www.w3schools.com/howto/howto_css_modal_images.asp
// .obfl .objekte, .oben .objekte, .unten .objekte
$(document).on('click', '#test2 .objekte', function(){
    var modal = document.getElementById('myModalKitchen');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption1");
        modal.style.display = "block";
        modalImg.src = this.src;
        // captionText.innerHTML = this.alt;
    var span = document.getElementById("close1");
    span.onclick = function() {
        modal.style.display = "none";
    };
});
$(document).on('click', '#obj .objekte', function(e){
    // TODO nach auswählen Verschiebbar machen !
    // if (e.ctrlKey || e.shiftKey) {
    //     if (!$(this).hasClass('selected-multiple')) {
    //         $(this).addClass('selected-multiple');
    //     } else {
    //         $(this).removeClass("selected-multiple");
    //     }
    //         return;
    // } else {
    //     $(this).removeClass('selected-multiple').siblings().removeClass('selected-multiple');
    // }
    let modal = document.getElementById('myModalObj');
    let modalImg = document.getElementById("img02");
    let captionText = document.getElementById("caption2");
    console.log("$('#obj').scrollTop() " + $('#obj').scrollTop());
    modal.style.top = $('#obj').scrollTop() + "px";

    modal.style.display = "block";
    modalImg.src = this.src;
    // captionText.innerHTML = this.alt;
    let span = document.getElementById("close2");
    span.onclick = function() {
        modal.style.display = "none";
    };
});

$(document).on('click', '#closeAlert', function(){
    // document.getElementById('myModalAlert').style.display ="none";
    // $('#myModalAlert').fadeOut(300);
    // $('#myModalAlert').css('opacity', '0').css('display', 'none');
    $('#myModalAlert').css('opacity','0');
    $('#myModalAlert').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
        function(e) {
            $('#myModalAlert').css('display','none');
        });

    // $('#myModalAlert').css('display','none');
    // $('#myModalAlert').css('visibility','hidden');

});


// function selectMultipleObjects() {
//     if ()
//     $('.regal').multipleSortable({
//         connectWith: '.regalSort'
//     });
//
// }
// $( ".regalSort" ).sortable( "refresh" );

// $(document).ready(function () {
//     $('.regalSort').multisortable();
// });






