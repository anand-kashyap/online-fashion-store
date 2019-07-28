$( function() {
  console.log('works');
  
    // Loop over them and prevent submission
    $('#save').on('click', function(evt){
      evt.preventDefault();
      evt.stopPropagation();
      // let form = $(this);
      let valid = $('#needs-validation').valid();
      console.log(valid);
      
      if (valid === false) {
      }
      $('#needs-validation').addClass('was-validated');
    });
});