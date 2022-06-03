<!-- <script>
let bt =document.getElementById('btsend');
document.getElementById('progress-bar').value=0;
bt.addEventListener('click',function(event){
        event.preventDefault();
        let types=document.getElementsByName('type');
        let selectType=null;
        for (type of types){
            if(type.checked){
                selectType=type.value;
            }
        }
	let files =document.getElementById('files');
        if(files.files.length >0 && selectType!==null){
            let formdata = new FormData();
            let formdata2 = new FormData();
            for(file of files.files){
                if(file.type==="application/pdf"){
                    formdata.append("fichier[]",file);
                    formdata2.append('nom[]',file.name);
                }
            } 
            formdata.append("type",selectType);
            let xhr = new XMLHttpRequest();
            xhr.open("POST","http://localhost/PDF_Site_M1/Src/Modele/UploadFiles.php",true);
            xhr.upload.addEventListener('progress',fprogress,false);
            xhr.onreadystatechange=function(){Uploadfini(formdata2,selectType,xhr)};
                
            xhr.send(formdata);
        }
});
function Uploadfini(formdata2,selectType,xhr){
    if (xhr.readyState === 4 && xhr.status === 200) {
                    let response=xhr.responseText;
                    if(response!=='il y eu un probleme'){
                        formdata2.append('type',selectType);
                        let xhr2 = new XMLHttpRequest();
                        xhr2.open("POST","http://localhost/PDF_Site_M1/Src/Modele/UploadFiles.php",true);
                        xhr2.onreadystatechange=function(){metaEnd(xhr2)}
                    xhr2.send(formdata2);
                    }
                }
                document.getElementById('progress-bar').value=100;
}
function metaEnd(xhr){
    
    if (xhr.readyState === 4 && xhr.status === 200) {
        let response =xhr.responseText;
         console.log('je suis la response: '+response);
         if(response==='1'){
           
         }
         else{
             
         }
    }
}

function fprogress(event){
       let percent = 100 *(event.loaded / event.total);
       document.getElementById('progress-bar').value=percent;
}
</script> -->