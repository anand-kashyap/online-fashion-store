$( function() {
  $("#needs-validation").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: {
        required: true,
        minlength: 4
      },
      user_name: {
        required: true,
        minlength: 4
      },
      email: {
        required: true,
        email: true,
      },
      phone: {
        required: true,
        minlength: 10,
      },
      address: "required",
      company: "required",
      country: "required",
    },
    // Specify validation error messages
    messages: {
      name: "Please enter Customer Name",
      user_name: "Please enter Customer User Name",
      email: "Please enter Customer Email",
      phone: "Please enter Customer Phone",
      company: "Please enter Company",
      address: "Please select Customer Address",
      country: "Please select Customer Country",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});