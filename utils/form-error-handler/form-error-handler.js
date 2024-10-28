function formErrorHandler(errors = {}, submitBtnId, actionType) {
  for (const key in errors) {
    if (errors.hasOwnProperty(key) && errors[key]) {
      document.getElementById(submitBtnId).setAttribute("disabled", true);
      const inputField = document.getElementById(key + actionType);
      if (inputField) {
        inputField.classList.add("border-red-500");
        inputField.classList.remove("border-gray-300");
        inputField.classList.remove("border");

        const errorMessage = document.createElement("p");
        errorMessage.className = "text-red-600 text-sm mt-1";
        errorMessage.textContent = errors[key];
        inputField.parentNode.insertBefore(
          errorMessage,
          inputField.nextSibling
        );

        inputField.onchange = function () {
          inputField.classList.remove("border-red-500");
          inputField.classList.add("border-gray-300");

          if (errorMessage) errorMessage.remove();

          document.getElementById(submitBtnId).removeAttribute("disabled");
        };
      }
    }
  }
}

function clearErrorMessages() {
  const errorMessages = document.querySelectorAll(".text-red-600");
  errorMessages.forEach((msg) => msg.remove());

  const inputs = document.querySelectorAll("input, textarea");
  inputs.forEach((input) => {
    input.classList.remove("border-red-500");
  });
}
