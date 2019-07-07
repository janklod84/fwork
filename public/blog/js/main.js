$(function () {
   $('#lang').change(function () {

       // show value selected input
       // console.log($(this).val()); en, ru , fr

       // sent to url '/language/change?lang=en or ru , fr ...
       window.location = '/language/change?lang=' + $(this).val();

   });
});