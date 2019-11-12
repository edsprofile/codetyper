//var words = "for(int i = 0; i < 10; i++){\n    //code\n}";
var words = "int i = 0;";
//var displayWords = "for(int i = 0; i < 10; i++){<br />&nbsp&nbsp&nbsp&nbsp//code<br />}";
var displayWords = "int i = 0;";

var win = "for(int i = 0; i < 10; i++)";
var wordArrayEasy = ["char my_char = '';",
                     "float my_float = 0.0;",
                     "double my_double = 0.0;",
                     "int my_int = 0;",
                     "signed int my_signed_int = 0;",
                     "unsigned int my_unsigned_int = 0;",
                     "long int my_long_int = 0;",
                     "long double my_long_double = 0;",
                     "for(int i = 0; i < 10; i++)",
                     "while(i < 10)",
                     ""];

$("#display").html(displayWords);

$("textarea").keypress(function(event)
    {
	var ENTERKEY = 13;
	console.log($(this).val());
	console.log(words);
	
	if($(this).val() === words && event.keyCode === ENTERKEY)
	{
	    $("#display").html("Win");
	    $("#info").empty();
	}
	else if($(this).val() !== words && event.keyCode === ENTERKEY)
	{
	    $("#info").html("incorrect");
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
    });


function pickWords()
{
    var randomValue = Math.floor(Math.random() * wordArrayEasy);
}
