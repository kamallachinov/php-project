function validateFormFields(fields) {
  let hasError = false;
  fields.forEach((field) => {
    const input = document.getElementById(field.id);
    if (!input.value.trim()) {
      showError(input, `${field.label} is required.`);
      hasError = true;
    } else {
      clearError(input);
    }
  });
  return !hasError;
}

function formErrorHandler(errors, formIdentifier) {
  Object.keys(errors).forEach((fieldName) => {
    const errorMessage = errors[fieldName];
    const inputField = document.getElementById(`${fieldName}${formIdentifier}`);
    if (inputField) {
      showError(inputField, errorMessage);
    }
  });
}

function showError(input, message) {
  input.classList.add("border-red-500");
  input.classList.remove("border-gray-300");
  let errorMessage = input.nextElementSibling;
  if (!errorMessage || !errorMessage.classList.contains("error-message")) {
    errorMessage = document.createElement("p");
    errorMessage.className = "text-red-600 text-sm mt-1 error-message";
    input.parentNode.insertBefore(errorMessage, input.nextSibling);
  }
  errorMessage.textContent = message;
}

function clearError(input) {
  input.classList.remove("border-red-500");
  input.classList.add("border-gray-300");
  const errorMessage = input.nextElementSibling;
  if (errorMessage && errorMessage.classList.contains("error-message")) {
    errorMessage.remove();
  }
}

function resetForm(fields) {
  fields.forEach((field) => {
    const input = document.getElementById(field.id);
    input.value = "";
    clearError(input);
  });
}

function clearErrorMessages() {
  const errorMessages = document.querySelectorAll(".text-red-600");
  errorMessages.forEach((msg) => msg.remove());

  const inputs = document.querySelectorAll("input, textarea");
  inputs.forEach((input) => {
    input.classList.remove("border-red-500");
  });
}
