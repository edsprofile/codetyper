var words = "for(int i = 0; i < 10; i++)";
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

$("#display").html(words);

$("textarea").keypress(function(event)
    {
	var TABKEY = 9;
	var ENTERKEY = 13;
	console.log($(this).val());

	if(event.keyCode === TABKEY && event.preventDefault)
	{
	    console.log("hello");
	    event.preventDefault();
	    this.value += "    ";
	}
	
	if($(this).val() === words && event.keyCode === ENTERKEY)
	{
	    $("#display").html("Win");
	}
	else if($(this).val() !== words && event.keyCode === ENTERKEY)
	{
	    $("#display").html("Loss");
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
    })


function pickWords()
{
    var randomValue = Math.floor(Math.random() * wordArrayEasy);
    
}
