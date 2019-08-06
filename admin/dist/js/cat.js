$( function() {
  $("#needs-validation").validate({
    // Specify validation rules
    rules: {
      title: {
        required: true,
        minlength: 2
      },
      parent_category: "required"
    },
    // Specify validation error messages
    messages: {
      title: "Please enter Category Title",
      parent_category: "Please enter Parent Category"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});