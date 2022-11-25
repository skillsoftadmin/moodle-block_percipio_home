/* eslint-disable */
function callajax(Y,param) {

    $('.launch_course').one("click", function(e){
        e.preventDefault();
        $.ajax({type: "POST", url: param.cfgwwwroot+"/blocks/percipio_home/getlaunchurl.php",  data: { "url":param.launchurl, "sesskey":param.sesskey }}).done(function( result ) {
          
            if(result != '') {
                 window.open(result);
            } 
        });
    });
}