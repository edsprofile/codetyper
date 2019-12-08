var words = "for(int i = 0; i < 10; i++){\n    sum += i;\n}";
//var words = "for(int i = 0)";
var displayWords = "for(int i = 0; i < 10; i++){<br />&nbsp&nbsp&nbsp&nbspsum += i;<br />}";
//var displayWords = "for(int i = 0; i < 10; i++)";

var win = "for(int i = 0; i < 10; i++)";
var wordArrayEasy = ["char my_char = '';",
                     "float my_float = 0.0;",
                     "double my_double = 0.0;",
                     "int my_int = 0;",
                     "signed int my_signed_int = 0;",
                     "unsigned int my_unsigned_int = 0;",
                     "long int my_long_int = 0;",
                     "long double my_long_double = 0.0;"];

var wordArrayEasyDisplay = ["char my_char = '';",
                            "float my_float = 0.0;",
                            "double my_double = 0.0;",
                            "int my_int = 0;",
                            "signed int my_signed_int = 0;",
                            "unsigned int my_unsigned_int = 0;",
                            "long int my_long_int = 0;",
                            "long double my_long_double = 0.0;"];

var wordArrayHard = ["for(int i = 0; i < 10; i++){\n    sum += i;\n}",
                     "#include <stdio.h>\n\nint main(void)\n{\n    printf(\"hello, world\\n\");\n}",
                     "#include <stdio.h>\n\nint main(void)\n{\n    for(int i = 0; i < 101; i++)\n    {\n        if(i % 3 == 0)\n            printf(\"Fizz\");\n        if(i % 5 == 0)\n            printf(\"Buzz\");\n        if(i % 3 == 0 && i % 5 == 0)\n            printf(\"FizzBuzz\");\n        printf(\"\\n\");\n    }\n    return 0;\n}"];

var wordArrayHardDisplay = ["for(int i = 0; i < 10; i++){<br />&nbsp&nbsp&nbsp&nbspsum += i;<br />}",
                            "#include &ltstdio.h&gt<br /><br />int main(void)<br />{<br />&nbsp&nbsp&nbsp&nbspprintf(\"hello, world\\n\");<br />}",
                            "#include &ltstdio.h&gt<br /><br />int main(void)<br />{<br />&nbsp&nbsp&nbsp&nbspfor(int i = 0; i < 101; i++)<br />&nbsp&nbsp&nbsp&nbsp{<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspif(i % 3 == 0)<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspprintf(\"Fizz\");<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspif(i % 5 == 0)<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspprintf(\"Buzz\");<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspif(i % 3 == 0 && i % 5 == 0)<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspprintf(\"FizzBuzz\");<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspprintf(\"\\n\");<br />&nbsp&nbsp&nbsp&nbsp}<br />&nbsp&nbsp&nbsp&nbspreturn 0;<br />}<br />"];

init();

function init()
{
    
    if($(".mode.cleanbutton.uibutton.selected").text() === "Hard")
    {
        var randomIndex = Math.floor(Math.random() * wordArrayHard.length);
        words = wordArrayHard[randomIndex];
        displayWords = wordArrayHardDisplay[randomIndex];
    }
    else
    {
        var randomIndex = Math.floor(Math.random() * wordArrayEasy.length);
        words = wordArrayEasy[randomIndex];
        displayWords = wordArrayEasyDisplay[randomIndex];
    }
    $("#display").html(displayWords);
}

function removeEscape(textareaString)
{
    var regex = /\"/g;
    var string = textareaString.replace(regex, '"');
    return string;
}


$("#submit_word").on("click", function()
                     {
                         var string = removeEscape($("textarea").val());
                         console.log(string);
                         if(string == words)
                         {
                             $("#display").html("Win");
                             $("#display").addClass("center")
                             $("#info").empty();
                         }
                         else if($("textarea").val () !== words && $("#display").html() !== "Win")
                         {
                             $("#info").html("incorrect!");
                         }
                     });

$("textarea").keydown(function(event)
                      {
	                  var TABKEY = 9;

	                  if(event.keyCode === TABKEY)
	                  {
	                      event.preventDefault();
	                      this.value += "    ";
	                  }
                      });


$("#reset").on("click", function()
               {
	           $("#display").html(words);
                   $("#display").removeClass("center");
                   $("#info").empty();
                   init();
               });

$("#easybutton").on("click", function()
                    {
                        $("#hardbutton").removeClass("selected");
                        $("#easybutton").addClass("selected");
                        $("#reset").trigger("click");
                    });

$("#hardbutton").on("click", function()
                    {
                        $("#easybutton").removeClass("selected");
                        $("#hardbutton").addClass("selected");
                        $("#reset").trigger("click");
                    });

