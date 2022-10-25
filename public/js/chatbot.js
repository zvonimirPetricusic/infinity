"use strict";

// Class definition

var KTCChatbot = function () {
    // variables
    var chatbotOpen = 0;
    var all_words = [];
    var tags = [];
    var xy = [];
    var tag = false;

    var X_train = [];
    var Y_train = [];

    var message = false;

    var bag = [];

    var selectedTag = "notSelected";
    var d = false;
    
    var response = false;
    var found = false;

    // create user variables
    var create_name = false;
    var create_email = false;
    var create_password = false;

    // make reservation variables
    var reservation_name = false;
    var reservation_surname = false;
    var reservation_email = false;
    var reservation_phone = false;

    var selectedColor = 0;

    var handleChatbot = function(){
        $( "#chatbotContainerBtn" ).click(function() {
            if(chatbotOpen === 0){
                $('#chatbotContainerBtn').slideDown("slow");
                $('#chatbotContainerChat').slideUp("slow");
                chatbotOpen = 1;
            }else{
                $('#chatbotContainerBtn').slideUp("slow");
                $('#chatbotContainerChat').slideDown("slow");
                chatbotOpen = 0;
            }
          });

          $( "#chatbotHeader" ).click(function() {
            $('#chatbotContainerBtn').show();
            $('#chatbotContainerChat').hide();
            chatbotOpen = 0;
          });
    };

    var triggerConversation = function(){
        $( "#send" ).click(function() {
            selectedTag = false;
            message = false;
            message = $("#userInput").val();
            $( "#chatbotMessages" ).append( '<div class="userResponse">' + message + '</div>' );
            handleConversation();
        });



    };



    var handleConversation = function(){
        all_words = [];
        tags = [];
        xy = [];
        tag = false;

    
        X_train = [];
        Y_train = [];

    
        bag = [];

        $("#userInput").val("");

        $.getJSON("rijecnik.json", function(data){
            $(data.rijecnik).each(function (i) {
                d = data.rijecnik[i];
                $.each(d, function (k, v) {

                    if(k === 'oznaka'){
                        tag = v;
                        var countTags = 0;
                        tags.push({
                            title: tag, 
                            count:  countTags
                        });
                    }
                    if(k === 'predlosci'){
                        for(var word in v){
                            var tokenizedMessage = tokenizeMessage(v[word]);
                
                            var removedDuplicates = tokenizedMessage.filter(function(element,index,self){
                                return index === self.indexOf(element); 
                            });

                            for(var elem in removedDuplicates){
                                all_words.push(removedDuplicates[elem]);
                                var val = removedDuplicates[elem];
                                xy.push(tag);
                            }
                            
                        }                
                    }
                });
            })
            var bag = bagOfWords(message, all_words);

            for(var i in bag){
                if(bag[i] !== 0){
                    var type = xy[i];
                    for(var j in tags){
                        if(tags[j]["title"] === type){
                            tags[j]["count"] = tags[j]["count"] + bag[i];
                        }
                    }
                }
            }

            

            var biggest = 0;
            for(var j in tags){
                if(tags[j]["count"] > biggest){
                    biggest = tags[j]["count"];
                    selectedTag = tags[j]["title"];
                }
            }

            if(selectedTag === false){
                $.getJSON('/api/chatbot/scrapeGoogle?message=' + message, function (res) {
                    response = res.toString();
                    $( "#chatbotMessages" ).append( '<div class="chatbotResponse">Ne znam odgovor na to pitanje, ali Google zna: <a href="' + response + '">' + response + '</a></div>' );
                });
            }

            $(data.rijecnik).each(function (i) {
                var d = data.rijecnik[i];
                if(data.rijecnik[i]["oznaka"] === selectedTag){
                    var patterns = data.rijecnik[i]["odgovori"];
                    var randomIndex = Math.floor((Math.random() * 2) + 1);
                    if(selectedTag === "goodbye" || selectedTag === "greeting"){
                        response = patterns[randomIndex];
                        $( "#chatbotMessages" ).append( '<div class="chatbotResponse">' + response + '</div>' );
                    }else if(selectedTag === "createUser"){                         
                        create_name = prompt("Molimo unesite ime i prezime korisnika");
                        create_email = prompt("Molimo unesite email korisnika");
                        create_password = prompt("Molimo unesite lozinku korisnika");

                        $.post( "/api/chatbot/createUser?password=" + create_password + '&name=' + create_name + '&email=' + create_email, function( data ) {
                            if(data === "1"){
                                response = patterns[randomIndex];
                                $( "#chatbotMessages" ).append( '<div class="chatbotResponse">' + response + '</div>' );
                            }else{
                                $( "#chatbotMessages" ).append( '<div class="chatbotResponse">Nije moguće kreirati korisnika</div>' );
                            }
                        });                            
                        
                    }else if(selectedTag === "reservation"){                         
                        reservation_name = prompt("Molimo unesite Vaše ime");
                        reservation_surname = prompt("Molimo unesite Vaše prezime");
                        reservation_email = prompt("Molimo unesite Vašu email adresu");
                        reservation_phone = prompt("Molimo unesite Vaš broj telefona");

                        var id_item = message.match(/\d+/);
                        
                        $.post( "/api/chatbot/reservation?name=" + reservation_name + '&surname=' + reservation_surname + '&email=' + reservation_email + '&phone=' + reservation_phone + '&item_id=' + id_item[0], function( data ) {
                            if(data === "1"){
                                response = patterns[randomIndex];
                                $( "#chatbotMessages" ).append( '<div class="chatbotResponse">' + response + '</div>' );
                            }else{
                                $( "#chatbotMessages" ).append( '<div class="chatbotResponse">Nije moguće napraviti rezervaciju</div>' );
                            }
                        });                            
                        
                    }else if(selectedTag === "price"){
                        var item_id = message.match(/\d+/);
                        $.getJSON('/api/chatbot/' + selectedTag + '?item_id=' + item_id[0], function (res) {
                            response = patterns[randomIndex] + ': ' + res.toString() + ' HRK';
                            $( "#chatbotMessages" ).append( '<div class="chatbotResponse">' + response + '</div>' );
                        });
                    }else if(selectedTag === "color"){
                
                        $.getJSON('/api/chatbot/' + selectedTag, function (res) {
                            var html='';
                            response = patterns[randomIndex];
                            for(var key in res){
                                html+='<button type="button" class="colorsButtons" id="' + res[key]["color"] + '" value="' + res[key]["color"] + '" style="width: 20px; height: 20px; background: #' + res[key]["color"] + ';"></button>&nbsp;';
                            }
                            $( "#chatbotMessages" ).append( '<div class="chatbotResponse" id="chatbotResponseColor"> ' + response  + ':<br>' + html + '</div>' );

                            $(".colorsButtons").on('click', function(event){
                                selectedTag = 'selectedColor';
                                selectedColor = $( this ).val();
                                message = 'Odabrana je boja sa kodom: ' + selectedColor;
                                handleConversation();
                            });
                        });
                    }else if(selectedTag === "selectedColor"){
                      
                        $.getJSON('/api/chatbot/' + selectedTag + '?color=' + selectedColor, function (res) {
                            var html='';
                            response = patterns[randomIndex];
                            for(var key in res){
                                console.log(res[key]["color"]);
                                html+='<a href="/img/' + res[key]["filename"] + '" target="_blank">' + res[key]["name"] + '</a><br>';
                            }
                            $( "#chatbotMessages" ).append( '<div class="chatbotResponse" id="chatbotResponseColor"> ' + response  + ':<br>' + html + '</div>' );

                        });
                    }
                    else{
                        $.getJSON('/api/chatbot/' + selectedTag, function (res) {
                            response = patterns[randomIndex] + ': ' + res.toString();
                            $( "#chatbotMessages" ).append( '<div class="chatbotResponse">' + response + '</div>' );
                        });
                    } 
                }


    
            });


        }).fail(function(){
            console.log("An error has occurred.");
        });
    
    };

    function checkSim(x, y) {
        var s = stringSimilarity.compareTwoStrings(x, y);
        return s;
      };

    var tokenizeMessage = function(message){
        var extractedMessage = message.replace(/[^a-zA-Z ]/g, "");
        var lowerCaseMessage = extractedMessage.toLowerCase();
        var tokenizedMessage = lowerCaseMessage.split(" ");

        return tokenizedMessage;
    };

    var bagOfWordsNoSimilarity = function(message, words){
        var tokenizedMessage = tokenizeMessage(message);
        var arrLength = words.length;

        for(var i = 0; i < arrLength; i++){
            bag.push(0);
        }

        for(var word in words){
            for(var userInput in tokenizedMessage){
                if(words[word] === tokenizedMessage[userInput]){
                    bag[word] = bag[word] + 1;
                }
            }
        }

        return bag;        
    };

    var bagOfWords = function(message, words){
        var tokenizedMessage = tokenizeMessage(message);
        var arrLength = words.length;

        for(var i = 0; i < arrLength; i++){
            bag.push(0);
        }

        for(var word in words){
            for(var userInput in tokenizedMessage){
                var similarityCheck = checkSim(words[word],tokenizedMessage[userInput]);
                if(similarityCheck > 0.8 ){
                    bag[word] = bag[word] + 1;
                }
            }
        }

        return bag;        
    };

    return {
        // public functions
        init: function () {
            handleChatbot();
            triggerConversation();
        },
    };
}();

// On document ready
$( document ).ready(function () {
    KTCChatbot.init();
});