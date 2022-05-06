$(function() {
    validatorOpts = {
        rules: {
            imagetransferSource: {
                required: true
            },
            imagetransferDestination: {
                required: true
            },
            imagetransferSrcImages: {
                required: true
            }
        }
    };

    setupTimeoutElement('#add','', 1000);

    // save the original select list
    var oriSiteListHtml = $('#imagetransferSource').html();

    $('#imagetransferSource').on('change', function(e) {
        console.log('imagetransferSource Clicked');
        var eSrc = document.getElementById("imagetransferSource");
        var eDest = document.getElementById("imagetransferDestination");

        //get selected option code (use for PXEL API)
        var selSrcCode = eSrc.options[eSrc.selectedIndex].text;  
        selSrcCode = selSrcCode.substring(0,selSrcCode.indexOf(" - "));
        var selSrcValue = eSrc.options[eSrc.selectedIndex].value; //get selected option value

        var selDestValue = eDest.options[eDest.selectedIndex].value; 

        jQuery.ajax({
            type: "GET",
            url: 'index.php',
            dataType: 'text',
            mimeType: 'multipart/form-data',
            data: {node: 'imagetransfer', sub: 'imageTransferSrcImg',siteCode: selSrcCode},
            success: function (response) {
                console.log("Post Success");
                console.log("response:" + response);

                var selSrcImages = document.getElementById("imgTrfSrc");
                var parser = new DOMParser();
                var doc = parser.parseFromString(response, 'text/html');
                var htmlImgList = doc.getElementsByTagName("select")[0];

                $('#imagetransferDestination').html(oriSiteListHtml);   //Restore List
                eDest.value = selDestValue; //reset existing value
                if(selSrcValue != "")
                    $("#imagetransferDestination option[value='"+selSrcValue+"']").remove();   //Remove selected option

                if(htmlImgList)
                    selSrcImages.innerHTML = htmlImgList.outerHTML;
                else
                    selSrcImages.innerHTML = "No items found";
                
            },
            error: function(xhr, status, error) {
                console.log("status: " + status);
                console.log("error: " + error);
                console.log("responseText: " + xhr.responseText);
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
