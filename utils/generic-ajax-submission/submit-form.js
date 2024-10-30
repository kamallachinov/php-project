function submitForm(data, actionUrl, onSuccess) {
  $.ajax({
    url: actionUrl,
    type: "POST",
    data: data,
    success: function (response) {
      if (typeof response === "string") {
        response = JSON.parse(response);
      }
      if (response.message) {
        toastr.success(response.message);
      }
      onSuccess();
    },
    error: function (error) {
      toastr.error(
        error.responseJSON?.error || "An unexpected error occurred."
      );
      const errors = error.responseJSON?.errorData || {};
      formErrorHandler(errors, data.submitButtonId);
    },
  });
}
