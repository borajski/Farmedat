var filesArray = [];
function preview_images()
{
 var total_file=document.getElementById("images").files.length;
 for(var i=0;i<total_file;i++)
 {
   $('#image_preview').append("<img class='img-responsive img-thumbnail' src='"+URL.createObjectURL(event.target.files[i])+"' style='height:200px;'>");

  //$('#image_preview').append("<div class='col' id='slika"+i+"'><div class='img'><img class='img-responsive img-thumbnail' src='"+URL.createObjectURL(event.target.files[i])+"'><a href='#' onclick='brisi("+i+");return false;'><span class='xmark' title='obriši'><i class='fas fa-trash-alt'></i></span></a></div></div>");
//  filesArray.push(event.target.files[i]);
}
// document.getElementById("ispis").innerHTML = filesArray.length;
}
