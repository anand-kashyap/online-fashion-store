$( function() {
  $("#needs-validation").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      title: {
        required: true,
        minlength: 4
      },
      price: {
        required: true,
        min: 1,
        number: true
      },
      qty: {
        required: true,
        min: 1,
        number: true
      },
      category: "required",
      pImage: "required",
      shortdesc: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      title: "Please enter Product Title",
      price: "Please enter Product Price",
      qty: "Please enter Product Quantity",
      category: "Please enter Product Category",
      pImage: "Please select Product Image",
      shortdesc: {
        required: "Please provide a Short Description",
        minlength: "Short Description must be at least 5 characters long"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});