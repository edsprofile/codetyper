var words = "for(int i = 0; i < 10; i++)";
var win = "for(int i = 0; i < 10; i++)";
var wordArrayEasy = ["char my_char = '';",
                     "float my_float = 0.0;",
                     "double my_double = 0.0;",
                     "signed char my_char = '';",
                     "unsigned char my_char = '';",
                     "short my_short = 0;",
                     "short int my_sort_int = 0;",
                     "signed short my_signed_short = 0;",
                     "signed short int my_signed_short_int = 0;",
                     "int my_int = 0;",
                     "signed my_signed = 0;",
                     "signed int my_signed_int = 0;",
                     "unsigned my_unsigned = 0;",
                     "unsigned int my_unsigned_int = 0;",
                     "long my_long = 0;",
                     "long int my_long_int = 0;",
                     "signed long my_signed_long = 0;",
                     "signed long int my_signed_long_int = 0;",
                     "unsigned long my_unsigned_long = 0;",
                     "unsigned long int my_unsigned_long_int = 0;",
                     "long long my_long_long = 0;",
                     "long long int my_long_long_int = 0;",
                     "signed long long my_signed_long_long = 0;",
                     "signed long long int my_signed_long_long_int = 0;",
                     "unsigned long long my_unsigned_long_long = 0;",
                     "unsigned long long int my_unsigned_long_long_int = 0;",
                     "long double my_long_double = 0;"];

$("#display").html(words);

$("input").keypress(function(event){
  if(event.which === 13 && $(this).val() === words){
    $("#display").html("Win");
  }
  else if(event.which === 13 && $(this).val() !== words){
    $("#display").html("Loss");
  }
});

$("#reset").on("click", function(){
  $("#display").html(words);
})


