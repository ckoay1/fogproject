$(function() {
    validatorOpts = {
       rules: {
            imagetransferSource: {
                required: true,
                allSiteTransfer: true
            },
            imagetransferDestination: {
                required: true,
                allSiteTransfer: true
            },
            imagetransferSrcImages: {
                required: true
            }
        }
    };

    setupTimeoutElement('#add','', 1000);

    $.validator.addMethod("allSiteTransfer",function(value,element){
        var allSiteTransfer = document.getElementById("hidden_allSiteTransfer");
        if(allSiteTransfer.value == 1)
        {
            var eSrc = document.getElementById("imagetransferSource");
            var eDest = document.getElementById("imagetransferDestination");
            var currentSite = document.getElementById("hidden_currentSite");
    
            var selSrcCode = eSrc.options[eSrc.selectedIndex].text;  
            selSrcCode = selSrcCode.substring(0,selSrcCode.indexOf(" - "));
            
            var selDestCode = eDest.options[eDest.selectedIndex].text;  
            selDestCode = selDestCode.substring(0,selDestCode.indexOf(" - "));
            console.log('allSiteTransfer ' + allSiteTransfer.value);
            console.log('selSrcCode ' + selSrcCode);
            console.log('selDestCode ' + selDestCode);
            console.log('currentSite ' + currentSite.value);

            if( currentSite.value != selSrcCode && currentSite.value != selDestCode ){
              return false;
           }else{
             return true;
           }
        }else
            return true;

     },"Either source or destination must be your current site!" );

    // save the original select list
    var oriSiteListHtml = $('#imagetransferSource').html();
    $('#loading').hide();
    $(window).on('load', function () 
    { 
        var selSrcImages = document.getElementById("imagetransferSrcImages");
        if(selSrcImages)
            selSrcImages.innerHTML = '<option value="">- Please select an option -</option>';
    });

    $('#imagetransferSource').on('change', function(e) {
        console.log('imagetransferSource Clicked');
        var eSrc = document.getElementById("imagetransferSource");
        var eDest = document.getElementById("imagetransferDestination");

        //get selected option code (use for PXEL API)
        var selSrcCode = eSrc.options[eSrc.selectedIndex].text;  
        selSrcCode = selSrcCode.substring(0,selSrcCode.indexOf(" - "));
        var selSrcValue = eSrc.options[eSrc.selectedIndex].value; //get selected option value

        var selDestValue = eDest.options[eDest.selectedIndex].value; 

        $('#loading').show();
        jQuery.ajax({
            type: "GET",
            url: 'index.php',
            dataType: 'text',
            mimeType: 'multipart/form-data',
            data: {node: 'imagetransfer', sub: 'imageTransferSrcImg',siteCode: selSrcCode},
            success: function (response) {
                console.log("Post Success");
                console.log("response:" + response);

                var selSrcImages = document.getElementById("imagetransferSrcImages");
                var parser = new DOMParser();
                var doc = parser.parseFromString(response, 'text/html');
                var htmlImgList = doc.getElementsByTagName("select")[0];

                $('#imagetransferDestination').html(oriSiteListHtml);   //Restore List
                eDest.value = selDestValue; //reset existing value
                if(selSrcValue != "")
                    $("#imagetransferDestination option[value='"+selSrcValue+"']").remove();   //Remove selected option

                if(htmlImgList)
                    selSrcImages.innerHTML = htmlImgList.innerHTML;
                else
                    selSrcImages.innerHTML = '<option value="">- Please select an option -</option>';

                $('#loading').hide();
                
            },
            error: function(xhr, status, error) {
                console.log("status: " + status);
                console.log("error: " + error);
                console.log("responseText: " + xhr.responseText);
                $('#loading').hide();
            }
        });
        
    });
    $('#imagetransferDestination').on('change', function(e) {
        console.log('imagetransferDestination Clicked');
        var eDest = document.getElementById("imagetransferDestination");
        var eSrc = document.getElementById("imagetransferSource");
        
        var selDestValue = eDest.options[eDest.selectedIndex].value; 
        var selSrcValue = eSrc.options[eSrc.selectedIndex].value; 


        $('#imagetransferSource').html(oriSiteListHtml);   //Restore List
        eSrc.value = selSrcValue;
        if(selDestValue != "")
            $("#imagetransferSource option[value='"+selDestValue+"']").remove();   //Remove selected option

    });

    $('#addimagetransfer').on('click', function(e) { //apply submithandlerfunc
        console.log('addimagetransfer Clicked');
        validatorOpts = {
            submitHandler: submithandlerfunc
        };
        setupTimeoutElement('#addimagetransfer','', 1000);

    });

});
