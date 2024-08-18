document.addEventListener('DOMContentLoaded', (event) => {
    
    function isEmpty(value) {
        return value === '';
    }

    function validateForm(event) {
        var nameInput = document.getElementById('name');
        var addressInput = document.getElementById('address');
        var cityInput = document.getElementById('city');
        var countryInput = document.getElementById('country');
        var errorMessageName = document.getElementById('error-message-name');
        var errorMessageAddress = document.getElementById('error-message-address');
        var errorMessageCity = document.getElementById('error-message-city');
        var errorMessageCountry = document.getElementById('error-message-country')
        var submitButton = document.getElementById('submit-button');

        // Variables de validación
        var nameIsValid = false;
        var addressIsValid = false;
        var cityIsValid = false;
        var countryIsValid = false;

        if (isEmpty(nameInput.value)) {
            if (errorMessageName) {
                submitButton.disabled = true;
                errorMessageName.innerHTML = 'El campo está vacío';
                errorMessageName.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageName) {
                errorMessageName.innerHTML = '';
            }
            nameIsValid = true;
        }

        if (isEmpty(addressInput.value)) {
            if (errorMessageAddress) {
                submitButton.disabled = true;
                errorMessageAddress.innerHTML = 'El campo está vacío';
                errorMessageAddress.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageAddress) {
                errorMessageAddress.innerHTML = '';
            }
            addressIsValid = true;
        }

        if (isEmpty(cityInput.value)) {
            if (errorMessageCity) {
                errorMessageCity.innerHTML = 'El campo está vacío';
                errorMessageCity.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageCity) {
                errorMessageCity.innerHTML = '';
            }
            cityIsValid = true;
        }

        if (isEmpty(countryInput.value)) {
            if (errorMessageCountry) {
                errorMessageCountry.innerHTML = 'El campo está vacío';
                errorMessageCountry.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageCountry) {
                errorMessageCountry.innerHTML = '';
            }
            countryIsValid = true;
        }

        if (nameIsValid && addressIsValid && cityIsValid && countryIsValid) {
            submitButton.disabled = false;
        }
    }

    document.getElementById('name').addEventListener('input', validateForm);
    document.getElementById('address').addEventListener('input', validateForm);
    document.getElementById('city').addEventListener('input', validateForm);
    document.getElementById('country').addEventListener('input', validateForm);
    document.querySelector('form').addEventListener('submit', validateForm);
});