$(document).ready(function(){
  $('select').formSelect();
});

$(document).ready(function(){
    $('#GetFile').click(function () {
      var inputVal = $("select").val();
      if (inputVal == "csvFile") {
      getFile("generateCsv.php");
    } else if (inputVal == "xmlFile") {
      getFile("generateXml.php");
    }
  });
});

function sucess() {
  document.getElementById("sucess").innerHTML = "Eksportuota sėkmingai.";
}

function fail() {
  document.getElementById("fail").innerHTML = "Eksportuoti nepavyko.";
}

function getFile(fileName){
  if (fileName == "generateCsv.php") {
    $.ajax({
      type: "GET",
      url: "generateCsv.php",
      dataType: "json"
    }).done(function(res){
      // kodas kai viskas ok
      console.log(res); // kol kas i konsole bet galima paimti res.code, arba res.meesage ziureti i php kaip sukodintas objektas
      // alert(res.code);
      sucess();
    }).fail(function(response, ajaxOptions, thrownException){
      // pridetas atvejis kai kas nors sufailina , si dalis loge isspausdins problema
      console.log(response.status);
      console.log(ajaxOptions);
      console.log(thrownException);
      fail();
    });
  } else if (fileName == "generateXml.php") {
    $.ajax({
      type: "GET",
      url: "generateXml.php",
      dataType: "json"
    }).done(function(res){
      // kodas kai viskas ok
      console.log(res); // kol kas i konsole bet galima paimti res.code, arba res.meesage ziureti i php kaip sukodintas objektas
      // alert(res.code);
      sucess();
    }).fail(function(response, ajaxOptions, thrownException){
      // pridetas atvejis kai kas nors sufailina , si dalis loge isspausdins problema
      console.log(response.status);
      console.log(ajaxOptions);
      console.log(thrownException);
      fail();
    });
  }
}
