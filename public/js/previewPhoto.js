function previewFile(input){
		//console.log(input, input.files, input.files[0]);
        var file = input.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
				//console.log($(input).parent().find("img#previewImg"));
				$(input).parent().find("img#previewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
