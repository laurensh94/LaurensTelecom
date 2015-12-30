function autofillpostcode(data, formfill, formfields){
    myform=document.getElementById(formfill);
    details=data.details[0];
    if (formfields){
        for(key in formfields)
        {
            if (details[key]){
                if (myform[formfields[key]]){
                    myform[formfields[key]].value=details[key];
                }
            }
        }
    }else{
        $.each(details, function( key, val ) {
            if (myform[key]){ //key != 'postcode' &&
                myform[key].value=val;
            }
        });
    }
}
function readonlyfalse(formname, formfields){
    myform=document.getElementById(formname);
    if (formfields){                
        for(key in formfields){
            if (myform[formfields[key]].readOnly==true){
                myform[formfields[key]].readOnly=false;
            }
        }
    }else{
        $.each( myform, function( key, val ) {
            if (myform[key].readOnly==true){
                myform[key].readOnly=false;
            }
        });
    }
}
function initializecheckform(formname, fieldname, trigger, formfields){
    var $postalcode = $('#'+formname);
    var $fieldname= $('#'+fieldname);
    if($postalcode.length)
    {
      if (!$fieldname.length){
        $fieldname=$postalcode;
      }
      
        $fieldname.live(trigger, function(event)
      {
          
        event.preventDefault();
        var $form = $postalcode; //$(this);
        myform=document.getElementById(formname);
        streetnumber=myform["streetnumber"].value;
        postcode=myform["postcode"].value.toUpperCase();
        postcode=postcode.replace(' ','');
        if (postcode.length < 6 || postcode.length > 7 || !postcode.match(/^[0-9]{4}[a-z]{2}$/gi)){
            $('#message', $postalcode).text('Geef svp nog een geldige postcode op');
            return;
        }
        if (!(streetnumber > 0 && streetnumber <= 99999)){
            $('#message', $postalcode).text('Geef svp een geldig huisnummer op');
            return;
        }
        
        $.ajax({
          url: 'http://api.postcodedata.nl/v1/postcode/',
          data: 'streetnumber='+streetnumber+'&postcode='+postcode+'&ref='+location.hostname,
          dataType: 'json',
          success: function(response)
          {
            if(response.errormessage)
            {
              //no postcode, let the visitor change the address:
              readonlyfalse(formname);
              if(response.errormessage=='no results'){
                $('#message', $postalcode).text('Helaas geen adres gevonden, zijn de postcode en het huisnummer juist?');
              }
            }
            else
            {
              autofillpostcode(response, formname, formfields);
              $('#message', $postalcode).text('');
              //ok, let the visitor change the address:
              //readonlyfalse(formname);
            }
          },
          error: function(xhr, ajaxOptions, thrownError)
          {
              //wrong api url or service unavailable, make the form writable
              readonlyfalse(formname);
          }
        });
      });
    }
  }
//}


        /*var inputarr = new Array();
        inputarr['streetnumber'] = streetnumber;
        inputarr['postcode'] = postcode;
        inputarr['ref'] = location.hostname;*/
